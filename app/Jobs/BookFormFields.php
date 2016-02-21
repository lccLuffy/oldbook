<?php

namespace App\Jobs;

use App\Book;
use App\Category;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class BookFormFields extends Job
{
    use InteractsWithQueue, SerializesModels;

    /**
     * The id (if any) of the Book row
     *
     * @var integer
     */
    protected $book;

    /**
     * List of fields and default value for each field
     *
     * @var array
     */
    protected $fieldList = [
        'name' => '',
        'description' => '',
        'price' => '',
        'address' => '',
        'is_draft' => "0",
        'categories' => [],
        'phone_number' => '',
        'other_contact_way' => '',
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($book = null)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return array of fieldnames => values
     */
    public function handle()
    {
        $fields = $this->fieldList;
        if ($this->book) {
            $fields = $this->fieldsFromModel($this->book, $fields);
        }

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        if(!$fields['address'])
        {
            $fields['address'] = Auth::user()->address;
        }
        if(!$fields['phone_number'])
        {
            $fields['phone_number'] = Auth::user()->phone_number;
        }

        return array_merge(
            $fields,
            ['allCategories' => Category::lists('name')->all()]
        );
    }

    protected function fieldsFromModel($book, array $fields)
    {
        $fieldNames = array_keys(array_except($fields, ['categories']));

        $fields = ['id' => $book->id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $book->{$field};
        }

        $fields['categories'] = $book->categories()->lists('name')->all();

        dd($fields);

        return $fields;
    }
}
