<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    public function index()
    {
        // Mảng tĩnh (ôn tập PHP mảng)
        $students = [
            [
                'name' => 'Nguyễn An',
                'age' => 19,
                'email' => 'an@huit.edu.vn'
            ],
            [
                'name' => 'Trần Bình',
                'age' => 18,
                'email' => 'binh@huit.edu.vn'
            ],
            [
                'name' => 'Lê Chi',
                'age' => 17,
                'email' => 'chi@huit.edu.vn'
            ],
            [
                'name' => 'Phạm Dũng',
                'age' => 20,
                'email' => 'dung@huit.edu.vn'
            ],
            [
                'name' => 'Đỗ Em',
                'age' => 21,
                'email' => 'em@huit.edu.vn'
            ],
        ];
        return view('students.index', compact('students'));
    }
    public function indexDb()
    {
        $gender = request('gender'); // 'male' | 'female' | null
        $query = Student::query()->orderBy('id', 'desc');
        if ($gender) {
            $query->where('gender', $gender);
        }
        $students = $query->paginate(5)->appends(compact('gender'));

        return view('students.index_db', compact('students', 'gender'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Store new student with validation
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'age' => ['nullable', 'integer', 'min:16'],
            'gender' => ['nullable', 'in:male,female'],
        ]);

        Student::create($data);

        return redirect('/students/db')->with('success', 'Tạo mới thành công');
    }
}
