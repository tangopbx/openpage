function linkFormatter(value, row) {
    const html = [];
    html.push(
        `<a href="?display=openpage&view=form&id=${encodeURIComponent(row.id)}">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>&nbsp;`
    );
    html.push(
        `<a href="?display=openpage&action=delete&id=${encodeURIComponent(row.id)}" class="delAction">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>&nbsp;`
    );
    return html.join('');
}
$(document).ready(function() {
    $('#devices').chosen({
        placeholder_text_multiple: 'Select Devices'
    });
});