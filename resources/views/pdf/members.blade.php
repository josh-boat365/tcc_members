<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Members</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            margin: 20px auto;
            max-width: 260mm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header .logo {
            width: 60px;
        }

        .header h1 {
            font-family: "Arial Black", Arial, sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 1.2rem;
            margin: 5px 0;
        }

        .header h4 {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 0.9rem;
            margin: 5px 0;
        }

        .membership-title {
            font-family: "Arial Black", Arial, sans-serif;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin: 20px 0;
            font-size: 1.2rem;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            text-align: left;
            color: #000;
            table-layout: fixed;
            word-wrap: break-word;
        }

        thead {
            background-color: #f3f4f6;
            color: #000;
        }

        thead th {
            padding: 8px;
            border: 1px solid #ccc;
        }

        tbody tr {
            background-color: white;
            border-bottom: 1px solid #ddd;
        }

        tbody td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .flex {
            display: flex;
            align-items: center;
        }

        .rounded-full {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .member-info {
            padding-left: 10px;
        }

        .member-info div {
            font-size: 0.875rem;
            font-weight: 600;
        }
        .member-image{
            width: 3rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img class="logo" src="{{ asset('images/tcc-logo.png') }}" alt="Triumphant Christian Center - Logo">
            <h1>Triumphant Christian Center - Covenant Temple</h1>
            <h4>Pokuase Near Ampax Hotel, Off Nsawam Accra Road</h4>
            <h4>Email: tccpokuase@gmail.com Tel: +233 (0) 547255990</h4>
        </div>

        <!-- Membership Title -->
        <div class="membership-title">Membership Database</div>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>Member ID</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Department</th>
                        <th>Group</th>
                        <th>Year Joined</th>
                    </tr>
                </thead>
                <tbody id="member-table-body">
                    @foreach ($members as $index => $member)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>
                                <img class="member-image"
                                    src="{{ $member->image ? Storage::url($member->image) : asset('images/user-circle.svg') }}"
                                    alt="{{ $member->first_name }} image">
                            </td>
                            <td><span class="member-info">{{ $member->first_name }}
                                    {{ $member->last_name ? ', ' . $member->last_name : '' }}</span></td>

                            <td>{{ $member->code ?? '--' }}</td>
                            <td>{{ $member->gender ?? '--' }}</td>
                            <td>{{ $member->contact_1 ?? '--' }}{{ $member->contact_2 ? '/' . $member->contact_2 : '' }}
                            </td>
                            <td>{{ $member->location ?? '--' }}</td>
                            <td>{{ $member->department ?? '--' }}</td>
                            <td>{{ $member->group ?? '--' }}</td>
                            <td>{{ $member->year_joined ?? '--' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
