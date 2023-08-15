<table class="table table-bordered table-striped table-hover table-condensed">
    <tbody>
        <tr>
            <td colspan="2" id="view_qrcode" style="text-align: center;">{!! $qrcode !!}</td>
        </tr>
        <tr>
            <td>الاسم</td>
            <td id="view_name">{{ $invited->name }}</td>
        </tr>
        <tr>
            <td>الجوال</td>
            <td id="view_mobile">{{ $invited->mobile }}</td>
        </tr>
        <tr>
            <td>البريد الإلكتروني</td>
            <td id="view_email">{{ $invited->email }}</td>
        </tr>
        <tr>
            <td>الجهة التابع لها</td>
            <td id="view_organization">{{ $invited->organization }}</td>
        </tr>
        <tr>
            <td>المنصب</td>
            <td id="view_position">{{ $invited->position }}</td>
        </tr>
    </tbody>
</table>