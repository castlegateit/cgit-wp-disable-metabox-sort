jQuery(function () {
    const containers = jQuery('.meta-box-sortables');

    if (containers.length === 0) {
        return;
    }

    if (typeof containers.sortable('instance') === 'object') {
        containers.sortable('destroy');
        return;
    }

    let interval = window.setInterval(function () {
        if (typeof containers.sortable('instance') === 'object') {
            containers.sortable('destroy');
            window.clearInterval(interval);
        }
    }, 50);

    let timeout = window.setTimeout(function () {
        window.clearInterval(interval);
    }, 2000);
});
