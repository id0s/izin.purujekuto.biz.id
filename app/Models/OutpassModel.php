namespace App\Models;
use CodeIgniter\Model;

class OutpassModel extends Model
{
    protected $table = 'outpass_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'reason', 'destination', 'out_date', 'in_date', 'status', 'qr_code'];
    
    public function getRequestsWithStudent()
    {
        return $this->select('outpass_requests.*, users.name as student_name')
                    ->join('users', 'users.id = outpass_requests.student_id')
                    ->findAll();
    }
}