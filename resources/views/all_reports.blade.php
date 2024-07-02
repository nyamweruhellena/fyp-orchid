<!-- resources/views/reports_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>All Reports</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ffffff;
        }

        th, td {
            border: 1px solid #999;
            padding: 0.75rem;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="table-responsive">
        <h3>All Reports <span style="float:right">{{ date('D, M d, Y') }}</span></h3>
        <table>
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Property</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Cost</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Date</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($reports as $report)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $report->property->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $report->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $report->cost }}</td>
                        <td class="py-3 px-6 text-left">{{ $report->description }}</td>
                        <td class="py-3 px-6 text-left">{{ $report->status }}</td>
                        <td class="py-3 px-6 text-left">{{ $report->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
