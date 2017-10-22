$(document).ready(function () {

    $(document).on('click', '#take_task', function (e) {

        $task_id = $(this).data('task-id');

        swal({
                title: "Вы уверены?",
                text: "Если во согласитесь, но в итоге ничего не сделаете, то ваша репутация будет испорчена",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#66CC99",
                confirmButtonText: "Точно помогу",
                cancelButtonText: "Отмена",
                closeOnConfirm: false
            },
            function () {

                $.ajax({
                    type: "POST",
                    url: "/ajax/take-task",
                    data: {
                        "task_id": $task_id,
                        _csrf: yii.getCsrfToken()
                    },
                    cache: false,

                    success: function (response) {
                        if (!response) {
                            $.notify({
                                title: '<strong>Ошибка</strong><br>',
                                message: "норм, но ответ пустой"
                            }, {
                                type: 'warning'
                            });
                        }
                        else {
                            swal({
                                title: "Успешно!",
                                text: "Эта задача будет отображаться на боковой панели",
                                type: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            $('.user-take').html(response);
                        }
                    },
                    error: function (response) {
                        $.notify({
                            title: '<strong>Ошибка</strong><br>',
                            message: "Может тебе стоит прекратить заниматься программированием?"
                        }, {
                            type: 'danger'
                        });
                    }
                });
            });
        e.preventDefault();
    });



    $(document).on('click', '#cancel_task', function (e) {

        $task_id = $(this).data('task-id');

        swal({
                title: "Вы уверены?",
                text: "Если во согласитесь, но в итоге ничего не сделаете, то ваша репутация будет испорчена",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EC644B",
                confirmButtonText: "Не смогу",
                cancelButtonText: "Отмена",
                closeOnConfirm: false
            },
            function () {

                $.ajax({
                    type: "POST",
                    url: "/ajax/cancel-task",
                    data: {
                        "task_id": $task_id,
                        _csrf: yii.getCsrfToken()
                    },
                    cache: false,

                    success: function (response) {
                        if (!response) {
                            $.notify({
                                title: '<strong>Ошибка</strong><br>',
                                message: "норм, но ответ пустой"
                            }, {
                                type: 'warning'
                            });
                        }
                        else {
                            swal({
                                title: "Зря вы так :(",
                                text: "Теперь ваш рейтинг понизится и другие пользователи станут меньше вам доверять.",
                                type: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            $('.single-task-ajax').html(response);
                        }
                    },
                    error: function (response) {
                        $.notify({
                            title: '<strong>Ошибка</strong><br>',
                            message: "Может тебе стоит прекратить заниматься программированием?"
                        }, {
                            type: 'danger'
                        });
                    }
                });
            });
        e.preventDefault();
    });



    $(document).on('click', '#create-task', function (e) {

        $.ajax({
            type: "POST",
            url: "/ajax/create-task",
            data: {
                'title': $('.task-title').val(),
                'location': $('.task-location').val(),
                'text': $('.task-text').val(),
                'people_count': $('.task-people_count').val(),
                'point': $('.task-point').val(),
                _csrf: yii.getCsrfToken()
            },
            cache: false,

            success: function (response) {
                if (!response) {
                    $.notify({
                        title: '<strong>Ошибка</strong><br>',
                        message: "норм, но ответ пустой"
                    }, {
                        type: 'warning'
                    });
                }
                else {
                    swal({
                        title: "Успешно",
                        text: "Ваша задача успешно создана!",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // $('.single-task-ajax').html(response);
                }
            },
            error: function (response) {
                $.notify({
                    title: '<strong>Ошибка</strong><br>',
                    message: "Может тебе стоит прекратить заниматься программированием?"
                }, {
                    type: 'danger'
                });
            }
        });

        e.preventDefault();
    });

});