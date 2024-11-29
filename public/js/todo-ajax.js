$('#todoForm').on('submit', (event) => {
    event.preventDefault();

    $.ajax({
        url: $(event.target).attr('action'),
        type: 'POST',
        data: $(event.target).serialize(),
        success: function (response) {
            event.target.reset();
            $('#successMessage').html(response.message).show();
            setTimeout(() => {
                $('#successMessage').slideUp();
            }, 1500);
            const data = response.data;
            let newItem = `
                <tr>
                    <td>
                        <a href="${data.update_url}" class="text-warning">
                            <i class="far fa-circle"></i>
                        </a>
                    </td>
                    <td>${data.task}</td>
                    <td class="text-muted">${data.difference}</td>
                    <td class="text-end pr-2">
                        <a href="${data.delete_url}" title="Remove" class="text-danger delete-item">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            `;

            $('#taskListTable').find('tbody').prepend(newItem);
        }
    });

});

$(document).on('click', '.delete-item', (event) => {
    event.preventDefault();
    const url = $(event.target).attr('href') || $(event.target).parent('a').attr('href');

    $.ajax({
        url: url,
        type: 'DELETE',
        data: {
            _token: $('input[name=_token]').val()
        },
        success: function (response) {
            $('#successMessage').html(response.message).show();
            setTimeout(() => {
                $('#successMessage').slideUp();
            }, 1500);
            $.ajax({
                url: '/index/list',
                type: 'GET',
                success: function (response) {
                    $('#taskListTable').find('tbody').html(response.pending);
                    $('#completedListTable').find('tbody').html(response.completed);
                }
            });
        }
    })

});

$(document).on('click', '.update-item', (event) => {
    event.preventDefault();
    const url = $(event.target).attr('href') || $(event.target).parent('a').attr('href');

    $.ajax({
        url: url,
        type: 'PATCH',
        data: {
            _token: $('input[name=_token]').val()
        },
        success: function (response) {
            $('#successMessage').html(response.message).show();
            setTimeout(() => {
                $('#successMessage').slideUp();
            }, 1500);
            $.ajax({
                url: '/index/list',
                type: 'GET',
                success: function (response) {
                    $('#taskListTable').find('tbody').html(response.pending);
                    $('#completedListTable').find('tbody').html(response.completed);
                }
            });
        }
    })

});
