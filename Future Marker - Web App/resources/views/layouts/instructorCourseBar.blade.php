<div class="col-md-3 mb-4 mb-md-0">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <img src="{{ asset($course['course_image']) }}" width="240" height="240" style="max-height: 250px;"
                    class="avatar img-circle img-thumbnail" alt="Course Image">
            </div>
            <div>
                <br>
                <div> <a href="{{ route('instructor.course',$course['id']) }}"><i class="fa fa-book"
                            aria-hidden="true"></i> Material</a></div>
                <hr class="my-2">
                <div> <a href="{{ route('instructor.post',$course['id']) }}"><i class="fa fa-picture-o"
                            aria-hidden="true"></i> Posts</a></div>
                <hr class="my-2">
                <div> <a href="{{ route('instructor.grades',$course['id']) }}"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i> Grades</a></div>
                <hr class="my-2">
                <div> <a href="{{ route('instructor.course.members',$course['id']) }}"><i class="fa fa-users"
                            aria-hidden="true"></i> Members</a>
                </div>
            </div>
        </div>
    </div>
</div>