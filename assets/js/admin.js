document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm(form.dataset.confirm || 'Are you sure you want to continue?')) {
            event.preventDefault();
        }
    });
});

document.querySelectorAll('[data-inbox-filter]').forEach((inbox) => {
    const search = inbox.querySelector('[data-inbox-search]');
    const statusFilter = inbox.querySelector('[data-inbox-status]');
    const count = inbox.querySelector('[data-inbox-count]');
    const emptyRow = inbox.querySelector('[data-inbox-empty]');
    const rows = [...inbox.querySelectorAll('[data-inbox-row]')];

    const filterRows = () => {
        const query = search.value.trim().toLocaleLowerCase();
        const status = statusFilter.value;
        let visibleRows = 0;

        rows.forEach((row) => {
            const matchesSearch = row.textContent.toLocaleLowerCase().includes(query);
            const matchesStatus = status === '' || row.dataset.status === status;
            row.hidden = !matchesSearch || !matchesStatus;
            visibleRows += row.hidden ? 0 : 1;
        });

        emptyRow.hidden = visibleRows !== 0;
        count.textContent = `${visibleRows} of ${rows.length} ${rows.length === 1 ? 'record' : 'records'}`;
    };

    search.addEventListener('input', filterRows);
    statusFilter.addEventListener('change', filterRows);
});
