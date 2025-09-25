    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
    ></script>
    <script src="../assets/js/app.js"></script>
  <script>
    const nav = document.getElementById('content');


window.onscroll = () => {
    if (window.scrollY > 70) {
        nav.classList.add("navbar-top")
        
    } else {
        nav.classList.remove("navbar-top")
    }
}
  </script>
  <script>
    $('.add').click(function () {
		if ($(this).prev().val()) {
    	$(this).prev().val(+$(this).prev().val() + 1);
		}
    });
    $('.sub').click(function () {
            if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
    });
</script>
</body>
</html>