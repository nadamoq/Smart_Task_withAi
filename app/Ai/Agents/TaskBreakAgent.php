<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class TaskBreakAgent implements Agent, Conversational, HasTools ,HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are an expert Project Management & Technical Architect AI Agent. Your core responsibility is to analyze a project request, feature description, or user intent, and break it down into a highly organized, production-ready project plan.';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
    public function schema(\Illuminate\Contracts\JsonSchema\JsonSchema $schema): array
    {
        return [
            'project_title' => $schema->string()->description('The definitive, clear title for the whole project/feature.')->required(),
            'summary' => $schema->string()->description('A high-level overview or strategic approach for executing this project breakdown.')->required(),
            'tasks' => $schema->array()->items(
                $schema->object([
                    'title' => $schema->string()->required(),
                    'description' => $schema->string()->required(),
                    'priority' => $schema->string()->enum(['high', 'med', 'low'])->required(),
                    'due_date' => $schema->string()->format('date')->required(),
                    'category' => $schema->string()->enum(['Programming', 'Design', 'Marketing'])->required(),
                ])
            )->required()
        ];
    }

}
