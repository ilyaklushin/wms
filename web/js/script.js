function edit(id) { 
	location.href += "/edit?id=" + id; 
}

function del(id) {
	var row = document.getElementById("row" + id);

	var payload = {
		id: id
	};

	var data = new FormData();
	data.append("json", JSON.stringify(payload));

	fetch(location.href + "/delete",
	{
	    method: "POST",
	    body: data
	})
	.then(function(res) {
		if (res.ok) row.remove(); 
	});
}