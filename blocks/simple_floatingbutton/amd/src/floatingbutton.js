define(['jquery'], function($) {
    function init() {
        // Create the floating button element
        var floatingButtonHtml = '<div class="header-action ml-2">' +
                                    '<div class="unique_floating_button position-fixed">' +
                                        '<button id="uniqueFloatingButton" class="btn btn-icon floatingbutton">' +
                                            '<i class="bi bi-book"></i>' +
                                        '</button>' +
                                    '</div>' +
                                  '</div>';
        // Create the modal HTML
        var modalHtml = '<div class="modal fade" id="dictionaryModal" tabindex="-1" role="dialog" aria-labelledby="dictionaryModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog modal-dialog-centered" role="document">' +
                                '<div class="modal-content">' +
                                    '<div class="modal-header">' +
                                        '<h2 class="modal-title" id="dictionaryModalLabel">Dictionary</h2>' +
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                    '</div>' +
                                    '<div class="modal-body">' +
                                        '<form class="dictionary-search-form">' +
                                            '<div class="input-group w-100 mb-3">' +
                                                '<input type="search" id="searchword" name="searchword" class="form-control" placeholder="Enter word">' +
                                                '<div class="input-group-append">' +
                                                    '<button class="btn btn-outline-secondary" type="button" id="search-button">' +
                                                        '<i class="bi bi-search"></i>' +
                                                    '</button>' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="form-check form-check-inline">' +
                                                '<input class="form-check-input" type="radio" name="dictionaryType" id="collegiate" value="collegiate" checked>' +
                                                '<label class="form-check-label" for="collegiate">Collegiate</label>' +
                                            '</div>' +
                                            '<div class="form-check form-check-inline">' +
                                                '<input class="form-check-input" type="radio" name="dictionaryType" id="thesaurus" value="thesaurus">' +
                                                '<label class="form-check-label" for="thesaurus">Thesaurus</label>' +
                                            '</div>' +
                                        '</form>' +
                                        '<div id="dictionary-results"></div>' +
                                    '</div>' +
                                    '<div class="modal-footer">'+
                                        '<ul class="list-unstyled m-0">' +
                                            '<li>Powered by&emsp;&emsp;:&nbsp; Merriam Webster Dictionary</li>' +
                                            '<li>Developed By&emsp;:&nbsp; IT Kaplan Edupac Indonesia</li>' +
                                        '</ul>' +
                                    '</div>'+
                                '</div>' +
                            '</div>' +
                        '</div>';

        // Append the floating button and modal to the body (only once)
        $('.header-actions-container').append(floatingButtonHtml);
        $('body').append(modalHtml);

        // Add click event listener for the button
        $('#uniqueFloatingButton').click(function() {
            $('#dictionaryModal').modal('show');
        });
    }

    return {
        init: init
    };
});
