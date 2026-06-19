<?php

declare(strict_types=1);

final class Lophoc
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT id, malop, tenlop, created_at FROM lophoc ORDER BY malop ASC'
        );

        return $stmt->fetchAll();
    }

    public function create(string $malop, string $tenlop): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO lophoc (malop, tenlop) VALUES (:malop, :tenlop)'
        );
        $stmt->execute([
            'malop' => $malop,
            'tenlop' => $tenlop,
        ]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT id, malop, tenlop, created_at FROM lophoc WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
        $lophoc = $stmt->fetch();

        return $lophoc === false ? null : $lophoc;
    }

    public function update(int $id, string $malop, string $tenlop): void
    {
        $stmt = $this->db->prepare(
            'UPDATE lophoc SET malop = :malop, tenlop = :tenlop WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'malop' => $malop,
            'tenlop' => $tenlop,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM lophoc WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function paginate(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare(
            'SELECT id, malop, tenlop, created_at FROM lophoc ORDER BY id DESC LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM lophoc');

        return (int) $stmt->fetchColumn();
    }

    public function existsByMalop(string $malop): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM lophoc WHERE malop = :malop'
        );
        $stmt->execute(['malop' => $malop]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function existsByMalopExceptId(string $malop, int $id): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM lophoc WHERE malop = :malop AND id <> :id'
        );
        $stmt->execute([
            'malop' => $malop,
            'id' => $id,
        ]);

        return (int) $stmt->fetchColumn() > 0;
    }
}
