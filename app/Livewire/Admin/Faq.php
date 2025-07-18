<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Faq as FaqModel;
use App\Models\FaqCategory;

class Faq extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $perPage = 10;
    
    // Filter input properties (for form inputs)
    public $searchInput = '';
    public $categoryInput = '';
    public $perPageInput = 10;
    
    // Form properties
    public $showModal = false;
    public $editMode = false;
    public $faqId;
    public $faq_category_id;
    public $question;
    public $answer;
    public $status = 'active';
    public $sort_order = 0;
    
    // Delete confirmation
    public $confirmingDeletion = false;
    public $faqToDelete;

    protected $rules = [
        'faq_category_id' => 'required|exists:faq_categories,id',
        'question' => 'required|string|max:500',
        'answer' => 'required|string',
        'status' => 'required|in:active,inactive',
        'sort_order' => 'nullable|integer|min:0'
    ];

    protected $messages = [
        'faq_category_id.required' => 'Kategori FAQ harus dipilih.',
        'faq_category_id.exists' => 'Kategori FAQ tidak valid.',
        'question.required' => 'Pertanyaan harus diisi.',
        'question.max' => 'Pertanyaan maksimal 500 karakter.',
        'answer.required' => 'Jawaban harus diisi.',
        'status.required' => 'Status harus dipilih.',
        'status.in' => 'Status tidak valid.',
        'sort_order.integer' => 'Urutan harus berupa angka.',
        'sort_order.min' => 'Urutan tidak boleh kurang dari 0.'
    ];

    public function mount()
    {
        // Initialize input values with current filter values
        $this->searchInput = $this->search;
        $this->categoryInput = $this->selectedCategory;
        $this->perPageInput = $this->perPage;
    }

    public function applyFilters()
    {
        $this->search = $this->searchInput;
        $this->selectedCategory = $this->categoryInput;
        $this->perPage = $this->perPageInput;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->perPage = 10;
        $this->searchInput = '';
        $this->categoryInput = '';
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
        $this->faqId = null;
        $this->faq_category_id = '';
        $this->question = '';
        $this->answer = '';
        $this->status = 'active';
        $this->sort_order = 0;
    }

    public function store()
    {
        $this->validate();

        try {
            FaqModel::create([
                'faq_category_id' => $this->faq_category_id,
                'question' => $this->question,
                'answer' => $this->answer,
                'status' => $this->status,
                'sort_order' => $this->sort_order ?: 0
            ]);

            session()->flash('message', 'FAQ berhasil ditambahkan.');
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan FAQ.');
        }
    }

    public function edit($id)
    {
        $faq = FaqModel::findOrFail($id);
        
        $this->editMode = true;
        $this->faqId = $faq->id;
        $this->faq_category_id = $faq->faq_category_id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->status = $faq->status;
        $this->sort_order = $faq->sort_order;
        
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        try {
            $faq = FaqModel::findOrFail($this->faqId);
            $faq->update([
                'faq_category_id' => $this->faq_category_id,
                'question' => $this->question,
                'answer' => $this->answer,
                'status' => $this->status,
                'sort_order' => $this->sort_order ?: 0
            ]);

            session()->flash('message', 'FAQ berhasil diperbarui.');
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui FAQ.');
        }
    }

    public function confirmDelete($id)
    {
        $this->faqToDelete = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        try {
            FaqModel::findOrFail($this->faqToDelete)->delete();
            session()->flash('message', 'FAQ berhasil dihapus.');
            $this->confirmingDeletion = false;
            $this->faqToDelete = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus FAQ.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            $faq = FaqModel::findOrFail($id);
            $faq->update([
                'status' => $faq->status === 'active' ? 'inactive' : 'active'
            ]);
            
            session()->flash('message', 'Status FAQ berhasil diubah.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengubah status FAQ.');
        }
    }

    public function render()
    {
        $faqs = FaqModel::with('category')
            ->when($this->search, function ($query) {
                $query->where('question', 'like', '%' . $this->search . '%')
                      ->orWhere('answer', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('faq_category_id', $this->selectedCategory);
            })
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        $categories = FaqCategory::orderBy('sort_order', 'asc')->get();

        return view('livewire.admin.faq', compact('faqs', 'categories'))
        ->layout('layouts.admin');
    }
}
