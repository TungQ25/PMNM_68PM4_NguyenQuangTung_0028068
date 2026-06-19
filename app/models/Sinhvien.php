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
            'SELECT id, hoten, masv, malop, created_at FROM sinhvien ORDER BY id DESC'
        );

        return $stmt->fetchAll();
    }

    public function create(string $hoten, string $masv, string $malop): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO sinhvien (hoten, masv, malop) VALUES (:hoten, :masv, :malop)'
        );
        $stmt->execute([
            'hoten' => $hoten,
            'masv' => $masv,
            'malop' => $malop,
        ]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT id, hoten, masv, malop, created_at FROM sinhvien WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
        $sinhvien = $stmt->fetch();

        return $sinhvien === false ? null : $sinhvien;
    }

    public function update(int $id, string $hoten, string $masv, string $malop): void
    {
        $stmt = $this->db->prepare(
            'UPDATE sinhvien SET hoten = :hoten, masv = :masv, malop = :malop WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'hoten' => $hoten,
            'masv' => $masv,
            'malop' => $malop,
        ]);
    }
    
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM sinhvien WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
    
    public function paginate(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare(
            'SELECT id, hoten, masv, malop, created_at FROM sinhvien ORDER BY id DESC LIMIT :limit OFFSET :offset'
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

    public function existsByMasvExceptId(string $masv, int $id): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM sinhvien WHERE masv = :masv AND id <> :id'
        );
        $stmt->execute([
            'masv' => $masv,
            'id' => $id,
        ]);

        return (int) $stmt->fetchColumn() > 0;
    }
}
