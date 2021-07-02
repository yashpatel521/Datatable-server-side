<html>

<head>
	<title>Datatables</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
	<style>
		body {
			font-family: calibri;
			color: #4e7480;
		}


		table#contact-detail tr td:first-child {
			position: sticky;
			width: 5em;
			left: 0;
			top: auto;
			border-top-width: 1px;
			/*only relevant for first row*/
			margin-top: -1px;
			background-color: white;
			/*compensate for top border*/
		}

		th:first-child {
			position: sticky;
			width: 5em;
			left: 0;
			top: auto;
			border-top-width: 1px;
			/*only relevant for first row*/
			margin-top: -1px;
			/*compensate for top border*/
			background-color: white;
		}

		.container {
			position: relative;
			width: 1000px;
			margin-left: 5em;
			/* border: 1px solid black; */
			padding: 0;
		}

		.dataTables_scroll {
			border: 1px solid;
		}

		th,
		td {
			border: 0.5px solid grey;
		}
	</style>
</head>

<body>
	Hide 2 col :<input type="checkbox" name="first_column" id="first_column">
	<hr>
	<div class="container">
		<table id="contact-detail" class="display nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Gender</th>
					<th>Password</th>
					<th>Date</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Gender</th>
					<th>Password</th>
					<th>Date</th>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
<script>
	$(document).ready(function() {
		$('#contact-detail tfoot th').each(function() {
			var title = $(this).text();
			$(this).html('<input type="text" placeholder="Search ' + title + '" />');
		});

		$('#contact-detail').dataTable({
			"scrollX": true,
			"pagingType": "numbers",
			"processing": true,
			"serverSide": true,
			"ajax": "server.php",
			initComplete: function() {
				// Apply the search
				this.api().columns().every(function() {
					var that = this;
					$('input', this.footer()).on('keyup change clear', function() {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			}
		});

		var dt = $('#contact-detail').DataTable();

		$('#first_column').change(function() {
			dt.columns(1).visible(!$(this).is(':checked'))
		});
	});
</script>

</html>