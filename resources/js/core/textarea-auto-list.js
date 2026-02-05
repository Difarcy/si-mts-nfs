const isTextarea = (el) => el && el.tagName === 'TEXTAREA';

const getLineBounds = (text, pos) => {
    const start = text.lastIndexOf('\n', Math.max(0, pos - 1)) + 1;
    const endIndex = text.indexOf('\n', pos);
    const end = endIndex === -1 ? text.length : endIndex;
    return { start, end };
};

const applyTextEdit = (el, start, end, insert) => {
    const value = String(el.value || '');
    const next = value.slice(0, start) + insert + value.slice(end);
    el.value = next;
    const cursor = start + insert.length;
    el.setSelectionRange(cursor, cursor);
    el.dispatchEvent(new Event('input', { bubbles: true }));
};

const detectListPrefix = (line) => {
    const numbered = line.match(/^(\s*)(\d+)([.)])\s+/);
    if (numbered) {
        return {
            type: 'numbered',
            indent: numbered[1] || '',
            number: parseInt(numbered[2], 10),
            delimiter: numbered[3],
            rawPrefix: numbered[0],
        };
    }

    const bulleted = line.match(/^(\s*)([-*•])\s+/);
    if (bulleted) {
        return {
            type: 'bulleted',
            indent: bulleted[1] || '',
            bullet: bulleted[2],
            rawPrefix: bulleted[0],
        };
    }

    return null;
};

const renumberNumberedLists = (el) => {
    if (!el || el.dataset.__renumbering === '1') return;
    const value = String(el.value || '');
    if (!value.includes('\n')) return;

    const originalLines = value.split('\n');
    const lines = originalLines.slice();
    let changed = false;

    const assigned = new Array(lines.length).fill(null);

    for (let i = 0; i < lines.length; i++) {
        const line = lines[i];
        const m = line.match(/^(\s*)(\d+)([.)])\s+(.*)$/);
        if (!m) continue;

        const indent = m[1] || '';
        const delimiter = m[3];
        const content = m[4] ?? '';

        const prev = i > 0 ? assigned[i - 1] : null;
        const prevLine = i > 0 ? originalLines[i - 1] : '';
        const prevMatch = prevLine.match(/^(\s*)(\d+)([.)])\s+/);

        const isContiguous = !!prevMatch && prevMatch[1] === indent && prevMatch[3] === delimiter;
        const nextNumber = isContiguous && prev ? prev.number + 1 : parseInt(m[2], 10);

        const normalized = `${indent}${nextNumber}${delimiter} ${content}`;
        if (normalized !== line) {
            changed = true;
        }

        assigned[i] = { indent, delimiter, number: nextNumber, oldDigits: m[2] };
        lines[i] = normalized;
    }

    if (!changed) return;

    const beforeCursor = typeof el.selectionStart === 'number' ? el.selectionStart : null;
    const hadFocus = document.activeElement === el;

    if (beforeCursor === null) {
        el.dataset.__renumbering = '1';
        el.value = lines.join('\n');
        el.dispatchEvent(new Event('input', { bubbles: true }));
        delete el.dataset.__renumbering;
        return;
    }

    let cursor = beforeCursor;
    let pos = 0;
    for (let i = 0; i < lines.length; i++) {
        const original = originalLines[i] ?? '';
        const m = original.match(/^(\s*)(\d+)([.)])\s+/);
        if (m) {
            const indentLen = (m[1] || '').length;
            const oldDigits = m[2] || '';
            const newDigits = String(assigned[i]?.number ?? parseInt(oldDigits, 10));
            const digitsStart = pos + indentLen;
            const digitsEnd = digitsStart + oldDigits.length;
            const delta = newDigits.length - oldDigits.length;

            if (cursor > digitsEnd) {
                cursor += delta;
            } else if (cursor >= digitsStart && cursor <= digitsEnd) {
                cursor = digitsStart + newDigits.length;
            }
        }
        pos += original.length + 1;
    }

    el.dataset.__renumbering = '1';
    el.value = lines.join('\n');
    if (hadFocus) {
        el.setSelectionRange(cursor, cursor);
    }
    el.dispatchEvent(new Event('input', { bubbles: true }));
    delete el.dataset.__renumbering;
};

export const initTextareaAutoList = () => {
    if (window.__textareaAutoListInit) return;
    window.__textareaAutoListInit = true;

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Enter') return;
        if (e.shiftKey || e.altKey || e.ctrlKey || e.metaKey) return;
        if (e.isComposing) return;

        const target = e.target;
        if (!isTextarea(target)) return;
        if (target.disabled || target.readOnly) return;
        if (target.dataset && target.dataset.noAutoList === '1') return;

        const value = String(target.value || '');
        const selStart = typeof target.selectionStart === 'number' ? target.selectionStart : 0;
        const selEnd = typeof target.selectionEnd === 'number' ? target.selectionEnd : 0;
        if (selStart !== selEnd) return;

        const { start: lineStart, end: lineEnd } = getLineBounds(value, selStart);
        const line = value.slice(lineStart, lineEnd);
        const beforeCursor = value.slice(lineStart, selStart);

        const prefix = detectListPrefix(beforeCursor);
        if (!prefix) return;

        const afterPrefix = beforeCursor.slice(prefix.rawPrefix.length);
        const isEndOfLine = selStart === lineEnd;
        const isOnlyPrefix = afterPrefix.trim() === '';

        e.preventDefault();
        e.stopPropagation();

        if (isEndOfLine && isOnlyPrefix) {
            const withoutPrefix = value.slice(0, lineStart) + value.slice(lineStart + prefix.rawPrefix.length);
            const cursorAfterRemoval = selStart - prefix.rawPrefix.length;
            const next = withoutPrefix.slice(0, cursorAfterRemoval) + '\n' + withoutPrefix.slice(cursorAfterRemoval);
            target.value = next;
            target.setSelectionRange(cursorAfterRemoval + 1, cursorAfterRemoval + 1);
            target.dispatchEvent(new Event('input', { bubbles: true }));
            return;
        }

        if (prefix.type === 'numbered') {
            const next = `${prefix.indent}${prefix.number + 1}${prefix.delimiter} `;
            applyTextEdit(target, selStart, selStart, `\n${next}`);
            return;
        }

        if (prefix.type === 'bulleted') {
            const next = `${prefix.indent}${prefix.bullet} `;
            applyTextEdit(target, selStart, selStart, `\n${next}`);
        }
    });

    document.addEventListener('input', (e) => {
        const target = e.target;
        if (!isTextarea(target)) return;
        if (target.disabled || target.readOnly) return;
        if (target.dataset && target.dataset.noAutoList === '1') return;
        if (target.dataset && target.dataset.__renumbering === '1') return;

        renumberNumberedLists(target);
    });
};
