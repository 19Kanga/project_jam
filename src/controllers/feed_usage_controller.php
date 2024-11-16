require_once __DIR__ . '/../models/feed_usage.php';
require_once __DIR__ . '/../config/database.php';

class FeedUsageController {
    private $db;
    private $feedUsage;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feedUsage = new FeedUsage($this->db);
    }

    public function getAllFeedUsage() {
        return $this->feedUsage->getAll();
    }

    public function addFeedUsage($data) {
        return $this->feedUsage->create($data);
    }

    public function updateFeedUsage($id, $data) {
        return $this->feedUsage->update($id, $data);
    }

    public function deleteFeedUsage($id) {
        return $this->feedUsage->delete($id);
    }
}
