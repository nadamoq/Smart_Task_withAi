<?php

namespace App\Ai\Agents;

use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Override;
use Stringable;

#[Provider(Lab::Groq)]
class BacklogAgent implements Agent
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */

    public function __construct(
        public string $idea,
        public int $sprintCount = 3
    ) {}

    public function instructions(): string
    {
        return 'You are an AI Product Owner. You must return ONLY valid JSON that strictly matches the provided schema. 
    Do not include any introductory text, no markdown code blocks, and no explanations. 
    Return raw JSON only.';
    }



    // public function schema(\Illuminate\Contracts\JsonSchema\JsonSchema $schema): array

    // {
    //     return [
    //         'project_title' => $schema->string()->required(),
    //         'project_summary' => $schema->string()->required(),
    //         'sprints' => $schema->array()->items(
    //             $schema->object([
    //                 'sprint_number' => $schema->integer()->required(),
    //                 'name' => $schema->string()->required(),
    //                 'goal' => $schema->string()->required(),
    //                 'stories' => $schema->array()->items(
    //                     $schema->object([
    //                         'id' => $schema->string()->required(),
    //                         'title' => $schema->string()->required(),
    //                         'priority' => $schema->string()->enum(['high', 'med', 'low'])->required(),
    //                         'as_a' => $schema->string()->required(),
    //                         'i_want' => $schema->string()->required(),
    //                         'so_that' => $schema->string()->required(),
    //                         'acceptance_criteria' => $schema->array()->items($schema->string())->required(),
    //                     ])
    //                 )->required()
    //             ])
    //         )->required()
    //     ];
    // }
  public function schema(): array
{
    return [
        'type' => 'object',
        'properties' => [
            'project_title' => ['type' => 'string'],
            'project_summary' => ['type' => 'string'],
            'sprints' => [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'sprint_number' => ['type' => 'integer'],
                        'name' => ['type' => 'string'],
                        'goal' => ['type' => 'string'],
                        'stories' => [
                            'type' => 'array',
                            'items' => [
                                'type' => 'object',
                                'properties' => [
                                    'id' => ['type' => 'string'],
                                    'title' => ['type' => 'string'],
                                    'priority' => ['type' => 'string'], // Keep it simple
                                    'as_a' => ['type' => 'string'],
                                    'i_want' => ['type' => 'string'],
                                    'so_that' => ['type' => 'string'],
                                    'acceptance_criteria' => [
                                        'type' => 'array',
                                        'items' => ['type' => 'string']
                                    ],
                                ],
                                'required' => ['id', 'title', 'as_a', 'i_want', 'so_that']
                            ]
                        ]
                    ],
                    'required' => ['sprint_number', 'name', 'goal', 'stories']
                ]
            ]
        ],
        'required' => ['project_title', 'project_summary', 'sprints']
    ];
}
    
}
