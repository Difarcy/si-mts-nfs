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
};
