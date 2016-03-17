var sort_cnt = 1;

function addSelectCriteria(name, item) {
    if (item.value === "") return;
    removeCriteriaByName(name);

    var li = '<li class="collection-item" data-criteria-type="' + name + '">' +
        '  <div>' +
        name + ' : ' + item.value +
        '    <a onclick="removeCriteriaByName(\'' + name + '\')" href="#!" class="secondary-content">' +
        '      <i class="material-icons">delete</i>' +
        '    </a>' +
        '  </div>' +
        '<input type="hidden" name="' + name + '" value="' + item.value + '"></input>' +
        '</li>';


    $('#criterias').find('p').remove();
    $('#criterias').append(li);
}

function addSliderCriteria(name, value) {
    removeCriteriaByName(name);

    var li = '<li class="collection-item" data-criteria-type="' + name + '">' +
        '  <div>' +
        name + ' : ' + Math.round(value) +
        '    <a onclick="removeCriteriaByName(\'' + name + '\')" href="#!" class="secondary-content">' +
        '      <i class="material-icons">delete</i>' +
        '    </a>' +
        '  </div>' +
        '<input type="hidden" name="' + name + '" value="' + Math.round(value) + '"></input>' +
        '</li>';


    $('#criterias').find('p').remove();
    $('#criterias').append(li);
}

function removeCriteriaByName(name) {
    $('#criterias').find('*[data-criteria-type="' + name + '"]')
        .slideUp(1000, function() {
            $(this).remove();
            var nb = $('#criterias').children().length;
            if (nb === 0) $('#criterias').append('<p>There is no critera selected yet.</p>');
        });
}

function addSorting(elem, event) {
    var prio = elem.value;
    var ord = $('#sorting-direction-checkbox').prop('checked') ? 'desc' : 'asc';

    if (prio === "") return;
    removeSortingByName(prio);

    var li = '<li class="collection-item" data-sorting-type="' + prio + '">' +
        '  <div>' +
        prio + ' : ' + ord +
        '    <a onclick="removeSortingByName(\'' + prio + '\')" href="#!" class="secondary-content">' +
        '      <i class="material-icons">delete</i>' +
        '    </a>' +
        '  </div>' +
        '<input type="hidden" name="prio' + sort_cnt + '" value="' + prio + '"></input>' +
        '<input type="hidden" name="ord'  + sort_cnt + '" value="' + ord + '"></input>' +
        '</li>';
    sort_cnt = sort_cnt + 1;
    $('#sortings').find('p').remove();
    $('#sortings').append(li);

    $(elem).find('option[value=""]').attr('selected','selected');
}

function addSortingInit(name, ord){
    removeSortingByName(name);

    var li = '<li class="collection-item" data-sorting-type="' + name + '">' +
        '  <div>' +
        name + ' : ' + ord +
        '    <a onclick="removeSortingByName(\'' + name + '\')" href="#!" class="secondary-content">' +
        '      <i class="material-icons">delete</i>' +
        '    </a>' +
        '  </div>' +
        '<input type="hidden" name="prio' + sort_cnt + '" value="' + name + '"></input>' +
        '<input type="hidden" name="ord'  + sort_cnt + '" value="' + ord + '"></input>' +
        '</li>';
    sort_cnt = sort_cnt + 1;
    $('#sortings').find('p').remove();
    $('#sortings').append(li);
}

function removeSortingByName(name) {
    $('#sortings').find('*[data-sorting-type="' + name + '"]')
        .slideUp(1000, function() {
            $(this).remove();
            var nb = $('#sortings').children().length;
            if (nb === 0) $('#sortings').append('<p>No sorting filter added yet.</p>');
        });
}
