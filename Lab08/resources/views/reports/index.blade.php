<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h1 class="mb-4">Eloquent Reports</h1>

    <div class="mb-5">
        <h3>1) Products with price > 100000</h3>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expensiveProducts as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ number_format($p->price, 2) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>{{ optional($p->category)->name }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">No data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        <h3>2) Category product counts</h3>
        <table class="table table-sm table-bordered">
            <thead>
            <tr><th>#</th><th>Category</th><th>Products</th></tr>
            </thead>
            <tbody>
            @forelse($categoriesWithCounts as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->name }}</td>
                    <td><span class="badge text-bg-primary">{{ $c->products_count }}</span></td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No data</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        <h3>3) Students with number of registered courses</h3>
        <table class="table table-sm table-bordered">
            <thead>
            <tr><th>#</th><th>Name</th><th>Email</th><th>Courses</th></tr>
            </thead>
            <tbody>
            @forelse($studentsWithCourseCounts as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td><span class="badge text-bg-info">{{ $s->courses_count }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No data</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
