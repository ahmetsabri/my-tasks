<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('task.create') }}" class="btn btn-primary text-white">Create Task</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $task->title }}</td>
                                    <td>

                                        @if ($task->status == 'pending')
                                            <div class="badge bg-red-400">{{ $task->status }}</div>
                                        @else
                                            <div class="badge bg-green-400">{{ $task->status }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>

                                        <form action=" {{ route('task.delete', $task) }} " method="POST">
                                            <a href="{{ route('task.edit', $task) }}"
                                                class="btn btn-success text-white btn-sm">Show/Edit</a>
                                            @csrf
                                            @method('delete')
                                            <button
                                                onclick="return confirm('Are you sure you want to delete this task?')"
                                                type="submit" class="btn btn-error text-white btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="toast toast-end">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <span class="text-white font-bold capitalize">{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
