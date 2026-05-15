namespace App\Controllers;
use App\Models\OutpassModel;

class Outpass extends BaseController
{
    protected $outpassModel;

    public function __construct() {
        $this->outpassModel = new OutpassModel();
    }

    // Dashboard Mahasiswa - List pengajuan sendiri
    public function index()
    {
        $data['requests'] = $this->outpassModel->where('student_id', session()->get('user_id'))->findAll();
        return view('outpass/student_dashboard', $data);
    }

    // Form Pengajuan
    public function create()
    {
        return view('outpass/apply_form');
    }

    // Simpan Pengajuan
    public function store()
    {
        $this->outpassModel->save([
            'student_id'  => session()->get('user_id'),
            'reason'      => $this->request->getPost('reason'),
            'destination' => $this->request->getPost('destination'),
            'out_date'    => $this->request->getPost('out_date'),
            'in_date'     => $this->request->getPost('in_date'),
            'status'      => 'pending'
        ]);
        return redirect()->to('/outpass')->with('success', 'Request submitted.');
    }

    // Panel Warden - Approve/Reject
    public function manage()
    {
        $data['requests'] = $this->outpassModel->getRequestsWithStudent();
        return view('outpass/warden_panel', $data);
    }

    public function updateStatus($id, $status)
    {
        $this->outpassModel->update($id, ['status' => $status]);
        return redirect()->back()->with('success', "Status updated to $status");
    }
}