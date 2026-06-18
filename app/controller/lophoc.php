<?php

declare(strict_types=1);

require_once ROOT_PATH . '/app/models/Lophoc.php';

final class LophocController extends Controller
{
    private ?Lophoc $lophoc = null;

    private function model(): Lophoc
    {
        if (!$this->lophoc instanceof Lophoc) {
            $this->lophoc = new Lophoc(Database::connection());
        }

        return $this->lophoc;
    }

    public function index(): void
    {
        $perPage = 5;
        $totalRows = $this->model()->countAll();
        $totalPages = max(1, (int) ceil($totalRows / $perPage));
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $this->render('lophoc/index', [
            'pageTitle' => 'Danh sach lop hoc',
            'lophoc' => $this->model()->paginate($perPage, $offset),
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalRows' => $totalRows,
            'offset' => $offset,
        ]);
    }

    public function create(): void
    {
        $error = '';
        $success = '';
        $old = [
            'malop' => '',
            'tenlop' => '',
        ];

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $old['malop'] = trim((string) ($_POST['malop'] ?? ''));
            $old['tenlop'] = trim((string) ($_POST['tenlop'] ?? ''));

            if ($old['malop'] === '' || $old['tenlop'] === '') {
                $error = 'Vui lòng nhập đầy đủ mã lớp và tên lớp.';
            } elseif ($this->model()->existsByMalop($old['malop'])) {
                $error = 'Mã lớp đã tồn tại.';
            } else {
                try {
                    $this->model()->create($old['malop'], $old['tenlop']);
                    $success = 'Thêm lớp học thành công.';
                    $old = [
                        'malop' => '',
                        'tenlop' => '',
                    ];
                } catch (PDOException $exception) {
                    unset($exception);
                    $error = 'Không thể thêm lớp học. Vui lòng thử lại.';
                }
            }
        }

        $this->render('lophoc/create', [
            'pageTitle' => 'Them lop hoc',
            'error' => $error,
            'success' => $success,
            'old' => $old,
        ]);
    }

    public function edit(string $id = ''): void
    {
        $lophocId = (int) $id;
        if ($lophocId <= 0) {
            $this->redirect('/lophoc');
        }

        $class = $this->model()->find($lophocId);
        if ($class === null) {
            $this->redirect('/lophoc');
        }

        $error = '';
        $success = '';
        $old = [
            'malop' => (string) ($class['malop'] ?? ''),
            'tenlop' => (string) ($class['tenlop'] ?? ''),
        ];

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $old['malop'] = trim((string) ($_POST['malop'] ?? ''));
            $old['tenlop'] = trim((string) ($_POST['tenlop'] ?? ''));

            if ($old['malop'] === '' || $old['tenlop'] === '') {
                $error = 'Vui lòng nhập đầy đủ mã lớp và tên lớp.';
            } elseif ($this->model()->existsByMalopExceptId($old['malop'], $lophocId)) {
                $error = 'Mã lớp đã tồn tại.';
            } else {
                try {
                    $this->model()->update($lophocId, $old['malop'], $old['tenlop']);
                    $success = 'Cập nhật lớp học thành công.';
                } catch (PDOException $exception) {
                    unset($exception);
                    $error = 'Không thể cập nhật lớp học. Vui lòng thử lại.';
                }
            }
        }

        $this->render('lophoc/edit', [
            'pageTitle' => 'Cap nhat lop hoc',
            'error' => $error,
            'success' => $success,
            'old' => $old,
            'lophocId' => $lophocId,
        ]);
    }

    public function delete(string $id = ''): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            $this->redirect('/lophoc');
        }

        $lophocId = (int) $id;
        if ($lophocId > 0) {
            $this->model()->delete($lophocId);
        }

        $this->redirect('/lophoc');
    }
}
