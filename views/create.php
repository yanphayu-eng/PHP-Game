<?php
include 'header.php';
?>

<style>
    :root {
        --epic-dark: #0d1117;
        --epic-card: #18181b;
        --epic-blue: #0074e4;
        --epic-blue-hover: #0086ff;
        --epic-text: #e4e4e7;
        --epic-input-bg: #2a2a2e;
        --epic-input-border: #3a3a3e;
    }

    .epic-form-container {
        background: var(--epic-card);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    }

    .epic-form-title {
        color: var(--epic-text);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        letter-spacing: -0.5px;
    }

    .epic-label {
        color: var(--epic-text);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .epic-input {
        background: var(--epic-input-bg);
        border: 1px solid var(--epic-input-border);
        color: var(--epic-text);
        border-radius: 4px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .epic-input:focus {
        background: var(--epic-input-bg);
        border-color: var(--epic-blue);
        color: var(--epic-text);
        box-shadow: 0 0 0 3px rgba(0, 116, 228, 0.2);
        outline: none;
    }

    .epic-input::placeholder {
        color: #71717a;
    }

    .epic-file-input {
        background: var(--epic-input-bg);
        border: 2px dashed var(--epic-input-border);
        color: var(--epic-text);
        border-radius: 4px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .epic-file-input:hover {
        border-color: var(--epic-blue);
        background: rgba(0, 116, 228, 0.05);
    }

    .epic-file-input:focus {
        border-color: var(--epic-blue);
        box-shadow: 0 0 0 3px rgba(0, 116, 228, 0.2);
        outline: none;
    }

    .epic-file-input::file-selector-button {
        background: var(--epic-blue);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: 600;
        margin-right: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .epic-file-input::file-selector-button:hover {
        background: var(--epic-blue-hover);
    }

    .epic-preview-container {
        background: #000;
        border-radius: 8px;
        overflow: hidden;
        margin-top: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .epic-preview-img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        display: block;
    }

    .btn-epic-save {
        background: var(--epic-blue);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .btn-epic-save:hover {
        background: var(--epic-blue-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 116, 228, 0.3);
    }

    .btn-epic-back {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--epic-text);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .btn-epic-back:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }

    .epic-helper-text {
        font-size: 0.875rem;
        color: #71717a;
        margin-top: 0.5rem;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            <h2 class="epic-form-title text-center mb-4">Add New Game</h2>

            <form action="index.php?action=store"
                  method="POST"
                  enctype="multipart/form-data"
                  class="epic-form-container">

                <div class="mb-4">
                    <label class="form-label epic-label">Game Name</label>
                    <input type="text" 
                           name="gameName" 
                           class="form-control epic-input" 
                           placeholder="Enter game title" 
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label epic-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white border-0" style="background: var(--epic-input-bg) !important; border: 1px solid var(--epic-input-border) !important; border-right: none !important;">$</span>
                        <input type="number" 
                               name="gamePrice" 
                               class="form-control epic-input" 
                               style="border-left: none;"
                               placeholder="0.00" 
                               step="0.01"
                               required>
                    </div>
                    <small class="epic-helper-text">Enter the game price in USD</small>
                </div>

                <div class="mb-4">
                    <label class="form-label epic-label">Game Cover Image</label>
                    <input type="file" 
                           name="gameImage" 
                           class="form-control epic-file-input" 
                           accept="image/*" 
                           onchange="previewImage(event)" 
                           required>
                    <small class="epic-helper-text">Recommended: 3:4 aspect ratio (e.g., 600x800px)</small>
                    
                    <div class="epic-preview-container">
                        <img id="imagePreview" 
                             src="uploads/default.png" 
                             class="epic-preview-img"
                             alt="Image Preview">
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-epic-save flex-fill">
                        <i class="bi bi-check-circle me-2"></i>Save Game
                    </button>
                    <a href="index.php" class="btn btn-epic-back" style="flex: 0 0 auto; min-width: 120px;">
                        <i class="bi bi-arrow-left me-2"></i>Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    if(event.target.files.length > 0) {
        const file = event.target.files[0];
        preview.src = URL.createObjectURL(file);
    } else {
        preview.src = "uploads/default.png";
    }
}
</script>

<?php
include 'footer.php';
?>