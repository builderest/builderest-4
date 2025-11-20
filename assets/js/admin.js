document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.table form select').forEach(select => {
        select.addEventListener('change', () => {
            select.closest('form').submit();
        });
    });
});
