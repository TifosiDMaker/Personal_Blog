	window.onload = function() {
		window.confirmIt = function (link) {
			bootbox.confirm("确定删除此条目吗？", function(result) {
					if (result) {window.location = link};
				});
		};

	}
