<?php

namespace App\Http\Controllers\Instructor;

use App\Assignment;
use App\Course;
use App\DynamicTest;
use App\FeatureTest;
use App\FinishedAssignment;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Instructor\Notify;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function showCreate($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $notifications = $user->notifications;
        return view('instructor/createAssginment', ['user' => $user, 'course' => $course, 'notifications' => $notifications]);
    }

    public function create($id)
    {
        $course = Course::findOrFail($id);
        $assignment = new Assignment;
        $assignment->course()->associate($course);
        $assignment->assignment_title = request('title');
        $doc_name = md5(uniqid() . microtime()) . '.doc';
        $doc_dir = "public/assignments/description/$doc_name";
        Storage::put($doc_dir, request('summernote'));
        $assignment->assignment_desc_dir = "public/assignments/description/$doc_name";
        $assignment->full_grade = "100";
        $assignment->compilation_grade = request('compileDegree');
        $assignment->style_grade = request('styleDegree');
        $assignment->dynamic_test_grade = request('dynamicTestDegree');
        $assignment->feature_test_grade = request('featureTestDegree');
        $assignment->assignment_deadline = request('deadline');
        $assignment->assignment_ma_main = "####";
        $assignment->assignment_repetition = request('attempts');

        if (request()->has('attachmentFiles')) {
            $attachments_dir = md5(uniqid() . microtime());
            foreach (request('attachmentFiles') as $file) {
                $file->storeAs('public/assignments/attachments/' . $attachments_dir, $file->getClientOriginalName());
            }
            $assignment->attachments_dir = 'public/assignments/attachments/' . $attachments_dir;
        }

        if (request()->has('modelAnswerFiles')) {
            $assignment_model_ans = md5(uniqid() . microtime());
            foreach (request('modelAnswerFiles') as $file) {
                $file->storeAs('public/assignments/model_answer/' . $assignment_model_ans, $file->getClientOriginalName());
            }
            $assignment->assignment_model_ans = 'public/assignments/model_answer/' . $assignment_model_ans;
        }
        $assignment->save();
        if (request()->has('DynamicInput')) {

            for ($i = 0; $i < count(request('DynamicInput')); $i++) {
                $dynamicTest = new DynamicTest;

                $dynamicTest->assignment()->associate($assignment);
                $dynamicTest->input = request('DynamicInput')[$i];
                $dynamicTest->output = request('DynamicOutput')[$i];
                $dynamicTest->hidden = filter_var(request('DynamicHidden')[$i], FILTER_VALIDATE_BOOLEAN);
                $dynamicTest->test_attachments = "####";
                $dynamicTest->save();
            }
        }

        if (request()->has('featureTest')) {

            for ($i = 0; $i < count(request('featureTest')); $i++) {
                $featureTest = new FeatureTest;
                $featureTest->assignment()->associate($assignment);
                $featureTest->test_name = request('featureTest')[$i];
                $featureTest->regex = request('regex')[$i];
                $featureTest->repetition = request('repetition')[$i];
                $featureTest->save();
            }
        }
        $notification_mssg = "An assignment has been created in " . $course->course_name . " course.";
        (new Notify)->createNotification($course, $notification_mssg);

        return redirect(route('instructor.course', $course->id))->with('success', 'Assignment has been created successfully.');
    }

    public function mobileCreate($id)
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'compileDegree' => 'required',
            'styleDegree' => 'required',
            'dynamicTestDegree' => 'required',
            'featureTestDegree' => 'required',
            'deadline' => 'required',
            'attempts' => 'required',

        ]);
        $user = User::findOrFail(Auth::id());

        $course = Course::findOrFail($id);
        $assignment = new Assignment;
        $assignment->course()->associate($course);
        $assignment->assignment_title = request('title');
        $doc_name = md5(uniqid() . microtime()) . '.doc';
        $doc_dir = "public/assignments/description/$doc_name";
        Storage::put($doc_dir, request('description'));
        $assignment->assignment_desc_dir = "public/assignments/description/$doc_name";
        $assignment->full_grade = "100";
        $assignment->compilation_grade = request('compileDegree');
        $assignment->style_grade = request('styleDegree');
        $assignment->dynamic_test_grade = request('dynamicTestDegree');
        $assignment->feature_test_grade = request('featureTestDegree');
        $assignment->assignment_deadline = request('deadline');
        $assignment->assignment_ma_main = "####";
        $assignment->assignment_repetition = request('attempts');

        if (request()->has('attachmentFiles')) {
            $attachments_dir = md5(uniqid() . microtime());
            foreach (request('attachmentFiles') as $file) {
                $file->storeAs('public/assignments/attachments/' . $attachments_dir, $file->getClientOriginalName());
            }
            $assignment->attachments_dir = 'public/assignments/attachments/' . $attachments_dir;
        }

        if (request()->has('modelAnswerFiles')) {
            $assignment_model_ans = md5(uniqid() . microtime());
            foreach (request('modelAnswerFiles') as $file) {
                $file->storeAs('public/assignments/model_answer/' . $assignment_model_ans, $file->getClientOriginalName());
            }
            $assignment->assignment_model_ans = 'public/assignments/model_answer/' . $assignment_model_ans;
        }

        if ($assignment->save()) {
            $notification_mssg = "An assignment has been created in " . $course->course_name . " course.";
            (new Notify)->createNotification($course, $notification_mssg);

            return response()->json('done');
        } else {
            return response()->json('sorry', 500);
        }

    }

    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $assignment = Assignment::findOrFail($id);
        $course = $assignment->course;
        $dynamicTests = $assignment->dynamicTests;
        $featureTests = $assignment->featureTests;
        $submitedAssignments = $assignment->finishedAssignments;
        $notifications = $user->notifications;
        return view('instructor/assignment', ['user' => $user, 'course' => $course, 'assignment' => $assignment, 'dynamicTests' => $dynamicTests, 'featureTests' => $featureTests, 'submitedAssignments' => $submitedAssignments, 'notifications' => $notifications]);
    }

    public function showEdit($id)
    {
        $user = User::findOrFail(Auth::id());
        $assignment = Assignment::findOrFail($id);
        $course = $assignment->course;
        $dynamicTests = $assignment->dynamicTests;
        $featureTests = $assignment->featureTests;
        $notifications = $user->notifications;
        return view('instructor/editAssginment', ['user' => $user, 'course' => $course, 'assignment' => $assignment, 'dynamicTests' => $dynamicTests, 'featureTests' => $featureTests, 'notifications' => $notifications]);
    }

    public function edit($id)
    {
        $user = User::findOrFail(Auth::id());

        $assignment = Assignment::findOrFail($id);
        $course = $assignment->course;
        $submitedAssignments = $assignment->finishedAssignments;

        $assignment->assignment_title = request('title');
        Storage::put($assignment->assignment_desc_dir, request('summernote'));
        $assignment->compilation_grade = request('compileDegree');
        $assignment->style_grade = request('styleDegree');
        $assignment->dynamic_test_grade = request('dynamicTestDegree');
        $assignment->feature_test_grade = request('featureTestDegree');
        $assignment->assignment_deadline = request('deadline');
        $assignment->assignment_repetition = request('attempts');

        if (request()->has('attachmentFiles')) {
            foreach (request('attachmentFiles') as $file) {
                $file->storeAs($assignment->attachments_dir, $file->getClientOriginalName());
            }
        }

        if (request()->has('modelAnswerFiles')) {
            foreach (request('modelAnswerFiles') as $file) {
                $file->storeAs($assignment->assignment_model_ans, $file->getClientOriginalName());
            }
        }
        $assignment->save();
        $dynamicTests = $assignment->dynamicTests;

        if (request()->has('DynamicInput')) {

            for ($i = 0; $i < count(request('DynamicInput')); $i++) {
                $dynamicTest = new DynamicTest;

                $dynamicTest->assignment()->associate($assignment);
                $dynamicTest->input = request('DynamicInput')[$i];
                $dynamicTest->output = request('DynamicOutput')[$i];
                $dynamicTest->hidden = filter_var(request('DynamicHidden')[$i], FILTER_VALIDATE_BOOLEAN);
                $dynamicTest->test_attachments = "####";
                $dynamicTest->save();
            }
        }
        foreach ($dynamicTests as $dynamicTest) {
            $dynamicTest->delete();
        }

        $dynamicTests = $assignment->dynamicTests;

        $featureTests = $assignment->featureTests;

        if (request()->has('featureTest')) {

            for ($i = 0; $i < count(request('featureTest')); $i++) {
                $featureTest = new FeatureTest;
                $featureTest->assignment()->associate($assignment);
                $featureTest->test_name = request('featureTest')[$i];
                $featureTest->regex = request('regex')[$i];
                $featureTest->repetition = request('repetition')[$i];
                $featureTest->save();
            }
        }
        foreach ($featureTests as $featureTest) {
            $featureTest->delete();
        }
        $featureTests = $assignment->featureTests;

        $notification_mssg = "The assignment " . $assignment->assignment_title . " has been Edited in " . $course->course_name . " course.";
        (new Notify)->createNotification($course, $notification_mssg);

        return redirect(route('instructor.assignment', $assignment->id))->with('success', 'Assignment has been edited successfully.');
    }

    public function delete($id)
    {
        $assignment = Assignment::findOrFail($id);
        $course = $assignment->course;
        $assignment->delete();
        return redirect(route('instructor.course', $course->id))->with('success', 'Assignment has been deleted successfully.');
    }

    public function submitedAssignmentShow($id)
    {
        $user = User::findOrFail(Auth::id());
        $finishedAssignment = FinishedAssignment::findOrFail($id);
        $assignment = $finishedAssignment->Assignment;
        $course = $assignment->course;
        $notifications = $user->notifications;

        return view('instructor/submitedAssignment', ['user' => $user, 'assignment' => $assignment, 'course' => $course, 'course' => $course, 'finishedAssignment' => $finishedAssignment, 'notifications' => $notifications]);

    }
}
