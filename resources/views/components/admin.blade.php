<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AGL | 19th Hole</title>
	@vite(['resources/css/app.css'])
</head>
<body>
	<div class="w-full grid grid-cols-1 md:grid-cols-4 lg:grid-cols-9 xl:grid-cols-12">
		<div class="col-span-1 md:col-span-1 lg:col-span-3 xl:col-span-4">

		</div>

		<div class="col-span-1 md:col-span-3 lg:col-span-6 xl:col-span-8">
			<div class="py-12 px-12">
				{{ $slot }}
			</div>
		</div>
	</div>
</body>
</html>
