<?php

declare(strict_types=1);

final class Sinhvien
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT id, hoten, masv, created_at FROM sinhvien ORDER BY id DESC'
        );

        return $stmt->fetchAll();
    }

    public function create(string $hoten, string $masv): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO sinhvien (hoten, masv) VALUES (:hoten, :masv)'
        );
        $stmt->execute([
            'hoten' => $hoten,
            'masv' => $masv,
        ]);
    }

    public function paginate(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare(
            'SELECT id, hoten, masv, created_at FROM sinhvien ORDER BY id DESC LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute(); 

        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM sinhvien');

        return (int) $stmt->fetchColumn();
    }

    public function existsByMasv(string $masv): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM sinhvien WHERE masv = :masv'
        );
        $stmt->execute(['masv' => $masv]);

        return (int) $stmt->fetchColumn() > 0;
    }
}
