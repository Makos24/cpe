<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Nickname</th>
        <th>Student ID</th>
        <th>Date of Birth</th>
        <th>State of Origin</th>
        <th>Marital Status</th>
        <th>Contact Address</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Facebook Username</th>
        <th>Best Course</th>
        <th>Best Lecturer</th>
        <th>Worst Course</th>
        <th>Hobbies</th>
        <th>Likes/Dislikes</th>
        <th>Worst Moment</th>
        <th>Best Moment</th>
        <th>Most Admired Classmate</th>
        <th>Role Model</th>
        <th>Future Aspiration</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->nickname }}</td>
            <td>{{ $user->student_id }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->states ? $user->states->name : '' }}</td>
            <td>{{ $user->marital_status_name }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->facebook_username }}</td>
            <td>{{ $user->best_course }}</td>
            <td>{{ $user->best_lecturer }}</td>
            <td>{{ $user->worst_course }}</td>
            <td>{{ $user->hobbies }}</td>
            <td>{{ $user->likes_dislikes }}</td>
            <td>{{ $user->worst_moment }}</td>
            <td>{{ $user->best_moment }}</td>
            <td>{{ $user->most_admired }}</td>
            <td>{{ $user->role_model }}</td>
            <td>{{ $user->future_aspiration }}</td>
        </tr>
    @endforeach
    </tbody>
</table>