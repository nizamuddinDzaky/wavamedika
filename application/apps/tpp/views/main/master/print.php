<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html>

<head>
	<title><?= $title ?></title>
	<style type="text/css">
		/* Styles go here */

		.page-header,
		.page-header-space {
			height: 2mm;
		}

		.page-footer,
		.page-footer-space {
			height: 2mm;

		}

		.hidden {
			display: none
		}

		.page-footer {
			position: fixed;
			bottom: 0;
			width: 100%;
			/* border-top: 1px solid black;  for demo */
			/* background: yellow; for demo */
		}

		.page-header {
			position: fixed;
			top: 0mm;
			width: 100%;
			/* border-bottom: 1px solid black; for demo */
			/*  background: yellow; for demo */
		}

		center table {
			width: 100%
		}

		.page {
			page-break-after: always;
		}

		table.report body tr:last-child {
			border: 1px white solid;
			border-bottom: 1px black solid;
		}

		@media print {
			.wrapper {
				page-break-inside: avoid;
			}

			table {
				page-break-inside: auto;
				font-size: 11px;
				font-family: 'Calibri';
			}

			tr {
				page-break-inside: avoid;
				page-break-after: auto
			}

			thead {
				display: table-header-group
			}

			tfoot {
				display: table-footer-group
			}

			@page {
				size: a4;
				/*margin: 20mm 20mm 10mm 20mm;*/
				/*margin: 2cm ;*/
			}

			body {}

			.wadwa {
				display: none
			}


			@page table.report body tr:last-child {
				border: 1px white solid;
				border-bottom: 1px black solid;
			}

		}
	</style>

</head>

<body>

	<div class="page-header" style="text-align: center">
		<button class="wadwa" style="margin:20px"> Print </button>
	</div>

	<div class="page-footer">
	</div>

	<table align="center" style="min-width:660px ; max-width: 660px">

		<thead>
			<tr>
				<td>
					<!--place holder for the fixed-position header-->
					<!-- <div class="page-header-space"></div> -->
				</td>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td>
					<!--*** CONTENT GOES HERE ***-->
					<div class="page">
						<?= $data ?>

						<center>

							<!-- data lainnya disisni  -->
						</center>
					</div>
				</td>
			</tr>
		</tbody>

		<tfoot>
			<tr>
				<td>
					<!--place holder for the fixed-position footer-->
					<!-- <div class="page-footer-space"></div> -->
				</td>
			</tr>
		</tfoot>

	</table>
	<script>
		function S(selector) {
			return document.querySelector(selector);
		}
		S(".wadwa").addEventListener("click", function() {

			window.print();

		})
	</script>
</body>

</html>