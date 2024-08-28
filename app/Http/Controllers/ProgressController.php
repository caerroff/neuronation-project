<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\DomainCategories;
use App\Models\Scores;
use Illuminate\Http\JsonResponse;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo '<h1>Progress API</h1>';
        echo '<h2>Make sure to run /initDb before trying to access the api</h2>';
        echo '<p>Available routes:</p>';
        echo '<ul>';
        echo '<li>GET /api/progress/{userId}</li>';
        echo '<li>GET /initDb</li>';
        echo '</ul>';

        return;
    }

    public function initDb()
    {
        try {
            //Create 3 user
            $users = User::all();
            $users->each->delete();
            for ($i = 0; $i < 3; $i++) {
                $user = new User();
                $user->password = Hash::make('user' . $i);
                $user->username = 'user' . $i;
                $user->save();
            }

            //Create one course
            $courses = Courses::all();
            $courses->each->delete();
            $course = new Courses();
            $course->name = 'course1';
            $course->save();

            //Create 5 DomainCategories
            $domainCategories = DomainCategories::all();
            $domainCategories->each->delete();
            for ($i = 0; $i < 5; $i++) {
                $domainCategory = new DomainCategories();
                $domainCategory->name = 'category' . $i;
                $domainCategory->save();
            }

            //Create 10 sessions
            $sessions = Sessions::all();
            $sessions->each->delete();
            for ($i = 0; $i < 10; $i++) {
                $session = new Sessions();
                $session->course_id = $course->course_id;
                // Random category
                $category = DomainCategories::all()[rand(0, 4)];
                $session->category_id = $category->category_id;
                $session->category_name = $category->name;
                $session->save();
            }

            //Create 10 score

            $scores = Scores::all();
            $scores->each->delete();
            for ($i = 0; $i < 10; $i++) {
                $score = new Scores();
                $score->uid = User::all()[rand(0, 2)]->user_id;
                $score->sid = Sessions::all()[$i]->id;
                $score->score = rand(0, 100);
                $score->save();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }


        return 'All entities created successfully';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Look for sessions where the user specified by the id parameter has a score
        $sessions = Sessions::whereIn('id', Scores::where('uid', $id)->pluck('sid'))->get();
        $sessionsWithScore = [];
        foreach ($sessions as $session) {
            $sessionsWithScore[] = [
                'id' => $session->id,
                'score' => Scores::where('sid', $session->id)->first()->score,
                'user' => User::where('user_id', Scores::where('sid', $session->id)->first()->uid)->first()->username,
                'uid' => User::where('user_id', Scores::where('sid', $session->id)->first()->uid)->first()->user_id,
                'date' => $session->created_at,
                'category' => $session->category_name,
            ];
        }
        $categories = [];
        foreach ($sessionsWithScore as $session) {
            //Checking if the category is already in the array
            if(!array_key_exists($session['category'], $categories)){
                $categories[$session['category']] = 1;
            }else{
                $categories[$session['category']] += 1;
            }
        }
        //Take top 3 categories
        arsort($categories);
        $categories = array_slice($categories, 0, 3);
        $categories = array_keys($categories);
        $returnedJSON = [
            'status' => 200,
            'history' => $sessionsWithScore,
            'lastCategories' => $categories,
        ];
        return new JsonResponse($returnedJSON);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
