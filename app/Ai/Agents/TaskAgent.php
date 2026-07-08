<?php

namespace App\Ai\Agents;


use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Concerns\RemembersConversations;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Override;
use Stringable;

class TaskAgent implements Agent, Conversational, HasStructuredOutput
{
    use Promptable, RemembersConversations;
 
    public function __construct(
        public string $idea,
        public string $mode = 'breakdown',
        public array $availableCategories = [] 
    ) {}

    public function instructions(): string
    {
        return 'You are an expert Agile Product Owner. Analyze ideas and break them down precisely into structured data based on the requested mode.';
    }

    public function schema(JsonSchema $schema): array
    {
        if ($this->mode === 'breakdown') {
          
            $categoriesOptions = !empty($this->availableCategories) 
                ? $this->availableCategories 
                : ['Programming', 'Design', 'Marketing'];

            return [
                'tasks' => $schema->array()->items(
                    $schema->object([
                        'title' => $schema->string()->required(),
                        'description' => $schema->string()->required(),
                        'priority' => $schema->string()->enum(['high', 'med', 'low'])->required(),
                        'due_date' => $schema->string()->format('date')->required(),
                        'category_name' => $schema->string()->enum($categoriesOptions)->required(),
                    ])
                )->required()
            ];
        }

       
        return [
            'project_title' => $schema->string()->required(),
            'project_summary' => $schema->string()->required(),
            'sprints' => $schema->array()->items(
                $schema->object([
                    'sprint_number' => $schema->integer()->required(),
                    'name' => $schema->string()->required(),
                    'goal' => $schema->string()->required(),
                    'stories' => $schema->array()->items(
                        $schema->object([
                            'id' => $schema->string()->required(),
                            'title' => $schema->string()->required(),
                            'priority' => $schema->string()->enum(['high', 'med', 'low'])->required(),
                            'story_points' => $schema->integer()->required(),
                            'as_a' => $schema->string()->required(),
                            'i_want' => $schema->string()->required(),
                            'so_that' => $schema->string()->required(),
                            'acceptance_criteria' => $schema->array()->items($schema->string())->required(),
                        ])
                    )->required()
                ])
            )->required()
        ];
    }
    
}
