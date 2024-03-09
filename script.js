const menuToggle = document.querySelector('.toggle');
const showcase = document.querySelector('.showcase');

menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    showcase.classList.toggle('active');
})

 document.addEventListener('DOMContentLoaded', function () {
        var deleteLinks = document.querySelectorAll('.delete-link');

        deleteLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                var deleteConfirmed = confirm('¿Estás seguro de que quieres eliminar este elemento?');

                if (deleteConfirmed) {
                    window.location.href = link.getAttribute('href');
                }
            });
        });
    });