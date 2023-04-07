<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <title>My Report</title>
    <style>
        /* Add your custom styles here */


        body {
            direction: rtl;
            font-family: 'iransans'
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: right;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>My Report</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>نام</th>
                <th>نویسنده</th>
                <th>قیمت</th>
                <th>تعداد صفحات</th>
                <th>تاریخ</th>
                <th>وضعیت</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->pages }}</td>
                    <td>{{ $book->created_at }}</td>
                    <td>{{ $book->status ? 'فعال' : 'غیرفعال' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
