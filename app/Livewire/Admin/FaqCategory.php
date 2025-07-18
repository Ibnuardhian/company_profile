<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FaqCategory as FaqCategoryModel;

class FaqCategory extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    
    // Filter inputs (temporary values before applying)
    public $searchInput = '';
    public $perPageInput = 10;

    // Form properties
    public $showModal = false;
    public $editMode = false;
    public $categoryId;
    public $name;
    public $sort_order = 0;

    // Delete confirmation
    public $confirmingDeletion = false;
    public $categoryToDelete;

    protected $rules = [
        'name' => 'required|string|max:255',
        'sort_order' => 'nullable|integer|min:0'
    ];

    protected $messages = [
        'name.required' => 'Nama kategori harus diisi.',
        'name.max' => 'Nama kategori maksimal 255 karakter.',
        'sort_order.integer' => 'Urutan harus berupa angka.',
        'sort_order.min' => 'Urutan tidak boleh kurang dari 0.'
    ];

    public function mount()
    {
        $this->searchInput = $this->search;
        $this->perPageInput = $this->perPage;
    }

    public function applyFilters()
    {
        $this->search = $this->searchInput;
        $this->perPage = $this->perPageInput;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->perPage = 10;
        $this->searchInput = '';
        $this->perPageInput = 10;
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->editMode = false;
        $this->categoryId = null;
        $this->name = '';
        $this->sort_order = 0;
    }

    public function store()
    {
        $this->validate();

        try {
            FaqCategoryModel::create([
                'name' => strtolower($this->name),
                'sort_order' => $this->sort_order ?: 0
            ]);

            session()->flash('message', 'Kategori FAQ berhasil ditambahkan.');
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan kategori FAQ.');
        }
    }

    public function edit($id)
    {
        $category = FaqCategoryModel::findOrFail($id);

        $this->editMode = true;
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->sort_order = $category->sort_order;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        try {
            $category = FaqCategoryModel::findOrFail($this->categoryId);
            $category->update([
                'name' => strtolower($this->name),
                'sort_order' => $this->sort_order ?: 0
            ]);

            session()->flash('message', 'Kategori FAQ berhasil diperbarui.');
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui kategori FAQ.');
        }
    }

    public function confirmDelete($id)
    {
        $this->categoryToDelete = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        try {
            $category = FaqCategoryModel::findOrFail($this->categoryToDelete);

            // Check if category has FAQs
            if ($category->faqs()->count() > 0) {
                session()->flash('error', 'Tidak dapat menghapus kategori yang masih memiliki FAQ.');
                $this->confirmingDeletion = false;
                $this->categoryToDelete = null;
                return;
            }

            $category->delete();
            session()->flash('message', 'Kategori FAQ berhasil dihapus.');
            $this->confirmingDeletion = false;
            $this->categoryToDelete = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus kategori FAQ.');
        }
    }

    public function render()
    {
        $categories = FaqCategoryModel::withCount('faqs')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . strtolower($this->search) . '%');
            })
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.faq-category', compact('categories'))
            ->layout('layouts.admin');
    }
}
