<?php
include 'header.php';
?>

<style>
    :root {
        --epic-dark: #0d1117;
        --epic-card: #18181b;
        --epic-hover: #1f1f23;
        --epic-blue: #0074e4;
        --epic-blue-hover: #0086ff;
        --epic-text: #e4e4e7;
        --epic-text-muted: #a1a1aa;
    }

    body {
        background: var(--epic-dark);
    }

    .epic-header {
        background: linear-gradient(135deg, #0d1117 0%, #1a1a2e 100%);
        padding: 3rem 0 2rem;
        margin-bottom: 2rem;
    }

    .epic-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--epic-text);
        letter-spacing: -0.5px;
    }

    .btn-epic {
        background: var(--epic-blue);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .btn-epic:hover {
        background: var(--epic-blue-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 116, 228, 0.3);
        color: white;
    }

    .epic-card {
        background: var(--epic-card);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .epic-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .epic-img-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3/4;
        background: #000;
    }

    .epic-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .epic-card:hover .epic-img {
        transform: scale(1.1);
    }

    .epic-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.7) 50%, transparent 100%);
        padding: 1.5rem 1rem 1rem;
    }

    .epic-game-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }

    .epic-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--epic-text);
    }

    .btn-edit {
        background: #fbbf24;
        border: none;
        color: #000;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: #000;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #dc2626;
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        background: #b91c1c;
        color: white;
        transform: translateY(-1px);
    }

    .empty-state {
        color: var(--epic-text-muted);
        font-size: 1.25rem;
        padding: 4rem 0;
    }
</style>

<div class="epic-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="epic-title mb-0">Game Library</h1>
            <a href="index.php?action=create" class="btn btn-epic btn-lg px-4">
                <i class="bi bi-plus-circle me-2"></i>Add Game
            </a>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <?php if($game && mysqli_num_rows($game) > 0): ?>
            <?php while($rows = mysqli_fetch_assoc($game)) : ?>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card epic-card border-0 h-100">
                    
                    <div class="epic-img-wrapper">
                        <img src="uploads/<?= htmlspecialchars($rows['gameImage']) ?>" 
                             class="epic-img" 
                             alt="<?= htmlspecialchars($rows['gameName']) ?>">
                        <div class="epic-overlay">
                            <h5 class="epic-game-title"><?= htmlspecialchars($rows['gameName']) ?></h5>
                            <p class="epic-price mb-0"><?= htmlspecialchars($rows['gamePrice']) ?> $</p>
                        </div>
                    </div>

                    <div class="card-body p-2 d-flex gap-2">
                        <a href="index.php?action=edit&id=<?= $rows['gameId'] ?>" 
                           class="btn btn-edit btn-sm flex-fill">
                           <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="index.php?action=delete&id=<?= $rows['gameId'] ?>" 
                           class="btn btn-delete btn-sm flex-fill"
                           onclick="return confirm('Delete this game?');">
                           <i class="bi bi-trash"></i> Delete
                        </a>
                    </div>

                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center empty-state">
                    <i class="bi bi-controller" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h4 class="mt-3">No games in your library</h4>
                    <p class="mb-0">Start building your collection</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
include 'footer.php';
?>