<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminRequestProfiler
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->isLocal()) {
            return $next($request);
        }

        if (! $request->is('admin*')) {
            return $next($request);
        }

        $path = $request->path();
        $shouldProfile = $request->boolean('perf')
            || str_ends_with($path, '/create')
            || str_ends_with($path, '/edit');

        if (! $shouldProfile) {
            return $next($request);
        }

        $connection = DB::connection();
        $connection->flushQueryLog();
        $connection->enableQueryLog();

        $startNs = hrtime(true);
        $startMemory = memory_get_usage(true);

        $response = $next($request);

        $durationMs = (hrtime(true) - $startNs) / 1_000_000;
        $memoryDeltaKb = (memory_get_usage(true) - $startMemory) / 1024;

        $queries = $connection->getQueryLog();
        $queryCount = count($queries);
        $queryTimeMs = array_sum(array_map(
            static fn (array $q): float => (float) ($q['time'] ?? 0),
            $queries
        ));

        $connection->flushQueryLog();
        $connection->disableQueryLog();

        $route = $request->route();

        $payload = [
            'method' => $request->method(),
            'path' => $path,
            'route' => $route?->getName(),
            'action' => $route?->getActionName(),
            'status' => $response->getStatusCode(),
            'duration_ms' => round($durationMs, 1),
            'db_queries' => $queryCount,
            'db_time_ms' => round($queryTimeMs, 1),
            'memory_kb' => (int) round($memoryDeltaKb),
        ];

        Log::info('admin_perf', $payload);

        $response->headers->set('X-Admin-Perf-Time-Ms', (string) $payload['duration_ms']);
        $response->headers->set('X-Admin-Perf-DB-Queries', (string) $payload['db_queries']);
        $response->headers->set('X-Admin-Perf-DB-Time-Ms', (string) $payload['db_time_ms']);
        $response->headers->set('X-Admin-Perf-Memory-KB', (string) $payload['memory_kb']);

        return $response;
    }
}

