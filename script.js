$(document).ready(function () {
    $('#form').on('submit', function (e) {
        e.preventDefault();
        const url = $('#url').val();
        $.ajax({
            url: 'shorten.php',
            method: 'POST',
            data: {url: url},
            success: function (data) {
                if (data.error) {
                    $('#result').html('Введите корректный url');
                } else {
                    console.log(data)

                    $('#result').html('Короткий URL-адрес: <a href="' + data.fullUrl + '">' + data.shortUrl + '</a>');
                }
            },
            error: function () {
                $('#result').html('Ошибка при сокращении URL-адреса.');
            }
        });
    });
});