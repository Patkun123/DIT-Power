// Facebook-style mention functionality
document.addEventListener('DOMContentLoaded', function() {
    // Handle mention suggestions with keyboard navigation
    document.addEventListener('keydown', function(e) {
        const mentionDropdown = document.querySelector('.mention-suggestions');
        if (!mentionDropdown || !mentionDropdown.style.display !== 'none') return;

        const suggestions = mentionDropdown.querySelectorAll('button');
        const activeIndex = Array.from(suggestions).findIndex(btn => 
            btn.classList.contains('bg-blue-50') || btn.classList.contains('dark:bg-blue-900')
        );

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = activeIndex < suggestions.length - 1 ? activeIndex + 1 : 0;
            updateActiveSuggestion(suggestions, nextIndex);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIndex = activeIndex > 0 ? activeIndex - 1 : suggestions.length - 1;
            updateActiveSuggestion(suggestions, prevIndex);
        } else if (e.key === 'Enter' && activeIndex >= 0) {
            e.preventDefault();
            suggestions[activeIndex].click();
        } else if (e.key === 'Escape') {
            // Hide suggestions
            Livewire.emit('hideMentionSuggestions');
        }
    });

    // Focus on textarea when reply is started
    Livewire.on('replyStarted', function() {
        setTimeout(() => {
            const activeTextarea = document.querySelector('textarea[wire\\:model*="newReply"]:not([style*="display: none"])');
            if (activeTextarea) {
                activeTextarea.focus();
                // Move cursor to end of text
                const length = activeTextarea.value.length;
                activeTextarea.setSelectionRange(length, length);
            }
        }, 100);
    });

    // Focus on textarea when nested reply is started
    Livewire.on('nestedReplyStarted', function() {
        setTimeout(() => {
            const activeTextarea = document.querySelector('textarea[wire\\:model*="newNestedReply"]:not([style*="display: none"])');
            if (activeTextarea) {
                activeTextarea.focus();
                // Move cursor to end of text
                const length = activeTextarea.value.length;
                activeTextarea.setSelectionRange(length, length);
            }
        }, 100);
    });

    // Handle @ symbol detection for better UX (post, comments, replies)
    document.addEventListener('input', function(e) {
        if (e.target.matches('textarea[wire\\:model="content"], textarea[wire\\:model*="newComment"], textarea[wire\\:model*="newReply"], textarea[wire\\:model*="newNestedReply"]')) {
            const value = e.target.value;
            const cursorPos = e.target.selectionStart;
            const textBeforeCursor = value.substring(0, cursorPos);
            
            // Check if user just typed @
            if (textBeforeCursor.endsWith('@') && !textBeforeCursor.endsWith('@@')) {
                // Trigger search with empty query to show all users
                const fieldName = getFieldName(e.target);
                Livewire.emit('searchUsers', '', fieldName);
            }
        }
    });

    // Click outside to close suggestions
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.mention-suggestions') && !e.target.matches('textarea[wire\\:model*="newComment"], textarea[wire\\:model*="newReply"], textarea[wire\\:model*="newNestedReply"]')) {
            Livewire.emit('hideMentionSuggestions');
        }
    });
});

function updateActiveSuggestion(suggestions, index) {
    suggestions.forEach((btn, i) => {
        btn.classList.toggle('bg-blue-50', i === index);
        btn.classList.toggle('dark:bg-blue-900', i === index);
    });
}

function getFieldName(textarea) {
    const wireModel = textarea.getAttribute('wire:model');
    if (wireModel === 'content') return 'post';
    if (wireModel.includes('newComment')) return 'comment';
    if (wireModel.includes('newReply')) {
        const match = wireModel.match(/newReply\.(\d+)/);
        return match ? `reply_${match[1]}` : 'reply';
    }
    if (wireModel.includes('newNestedReply')) {
        const match = wireModel.match(/newNestedReply\.(\d+)/);
        return match ? `nested_reply_${match[1]}` : 'nested_reply';
    }
    return 'comment';
}

// Add mention highlighting styles
const style = document.createElement('style');
style.textContent = `
    .mention-highlight {
        background-color: rgba(59, 130, 246, 0.1);
        border-radius: 3px;
        padding: 1px 2px;
        font-weight: 500;
    }
    
    .mention-suggestions {
        z-index: 9999;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .dark .mention-suggestions {
        border-color: #4b5563;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
    }
    
    .mention-suggestion-item {
        transition: background-color 0.15s ease-in-out;
    }
    
    .mention-suggestion-item:hover {
        background-color: #f3f4f6;
    }
    
    .dark .mention-suggestion-item:hover {
        background-color: #374151;
    }
`;
document.head.appendChild(style);
