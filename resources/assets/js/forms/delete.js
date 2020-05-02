document.addEventListener("DOMContentLoaded", function () {
    var forms = document.querySelectorAll('form');

    if (forms) {
        forms.forEach(function (form) {
            form.addEventListener('submit', function (submitEvent) {
                submitEvent.preventDefault();
                var message = "Do you want to remove the resource?";
                var isSuccess = confirm(message);

                if (isSuccess) {
                    this.submit();
                }
            });
        });
    }
});