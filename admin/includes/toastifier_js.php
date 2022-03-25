<?php
if ($_SESSION['success'] ?? null) {
?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(() => {
            Toastify({
                text: "<?php echo $_SESSION['success'] ?>",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                offset: {
                    x: 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                    y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                },
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",

                },
            }).showToast();
        })
    </script>
<?php
    unset($_SESSION['success']);
} ?>

<?php
if ($_SESSION['error']  ?? null) {
?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(() => {
            Toastify({
                text: "<?php echo $_SESSION['error'] ?>",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                offset: {
                    x: 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                    y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                },
                style: {
                    color: "white",
                    // background: "linear-gradient(to right, #A01A59, #E9BF18)",
                    background: "linear-gradient(to right, #FF6347, #F08080)",

                },
            }).showToast();
        })
    </script>
<?php
    unset($_SESSION['error']);
} ?>