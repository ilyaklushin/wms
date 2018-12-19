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

function printQR(UUID) {
	location.href = "/qr/show?message=" + UUID;
}

function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
      } else {
        node.parentNode.previousElementSibling.value = res;
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function saerch() {
	$text = document.getElementById("searchInput").value;
	console.log($text);
}