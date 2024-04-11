<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TaskController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/view",
 *     tags={"Tasks"},
 *     summary="Fetch all tasks",
 *     operationId="fetchTasks",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Request body for fetching tasks",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 example={"status": "completed"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *   )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */

    public function index()
    {
        return Task::all();
    }
/**
 * @OA\Post(
 *     path="/api/store",
 *     tags={"Tasks"},
 *     summary="Create a new task",
 *     operationId="createTask",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"name","email","phone","address"},
 *                 @OA\Property(property="name", type="string", example="Enter your name"),
 *                 @OA\Property(property="email", type="string", example="Enter your email"),
 *                 @OA\Property(property="phone", type="integer", example="Enter your phone"),
 *                 @OA\Property(property="address", type="string", example="Enter your address"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     )
 * )
 */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|integer',
            'address' => 'required|max:255',
        ]);

        return Task::create($validatedData);
    }


    public function show($id)
    {
        return Task::findOrFail($id);
    }

/**
 * @OA\Post(
 *     path="/api/update",
 *     tags={"Tasks"},
 *     summary="Update a task",
 *     operationId="updateTask",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"id", "name", "email", "phone", "address"},
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Updated name"),
 *                 @OA\Property(property="email", type="string", example="updated@email.com"),
 *                 @OA\Property(property="phone", type="string", example="1234567890"),
 *                 @OA\Property(property="address", type="string", example="Updated address"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Task not found"
 *     )
 * )
 */

    public function update(Request $request)
    {
        $id = $request->input('id');
        $task = Task::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'phone' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        $task->update($validatedData);

        return $task;
    }
/**
 * @OA\Post(
 *     path="/api/delete",
 *     tags={"Tasks"},
 *     summary="delete a task",
 *     operationId="deleteTask",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"id"},
 *                 @OA\Property(property="id", type="integer", example=1),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Task not found"
 *     )
 * )
 */

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
