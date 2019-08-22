<h2 style="text-align: center">{{ config('app.name', 'Laravel') }}</h2>
<img style="float: left;" src="{{asset('images/cocin.png')}}" width="100" height="100">
<img style="float: right;" src="{{url('storage/users/'.$user->image)}}" width="100" height="100">
<h4 style="text-align: center">Registration Details</h4>
<div style="margin-top: 20px;clear: both;">
    <table border="1" cellspacing="0" style="line-height: 35px; width: 99%; font-size: 17px;margin-top: 20px;">
        <tr>
            <td width="35%">Name</td>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{$user->phone}}</td>
        </tr>

        <tr>
            <td>LCC</td>
            <td>{{$user->lcc->name}}</td>
        </tr>

        <tr>
            <td>Group</td>
            <td>{{$user->group->name}}</td>
        </tr>
    </table>
</div>