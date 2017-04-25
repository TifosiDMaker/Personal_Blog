<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script type="text/javascript">
	window.onload = function() {
		var elems = document.getElementsByClassName('red_link');
		var confirmIt = function() {
			event.preventDefault();
			bootbox.confirm("确定删除此条目吗？", function(result) {
					if (result) {window.location =  };
				});
		};

		for (var i = 0, l = elems.length; i < l; i++) {
			elems[i].addEventListener('click', confirmIt, false);
		};
	}
</script>
