<x-app-layout title="Exam">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exam
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('exams.all')}}">
            <x-mine.crud
                :search="route('exams.index')"
                :addTitle="'Add Exam'"
                :addSub="'add a exam for the school.'"
                :addForm="'addExam'"
                :inputs="['name', 'subject_id', 'grade_level_id', 'description', 'num_of_questions', 'time_limit']"
                :addRoute="route('exams.store')"
                :dellAllRoute="route('exams.destroyAll')"
                :dellOneRoute="route('exams.index')"
                :updateTitle="'Update Exam'"
                :updateSub="'Update a exam of the school.'"
                :updateForm="'updateExam'"
                :updateRoute="route('exams.index')"
            >
                <x-slot name="thead">
                    <x-mine.th-cell col="name">
                        name
                    </x-mine.th-cell>
                    <x-mine.th-cell col="grade_level_name">
                        grade level
                    </x-mine.th-cell>
                    <x-mine.th-cell col="subject_name">
                        subject
                    </x-mine.th-cell>
                    <x-mine.th-cell col="description">
                        description
                    </x-mine.th-cell>
                    <x-mine.th-cell col="user_name">
                        author
                    </x-mine.th-cell>
                    <x-mine.th-cell col="created_at">
                        created
                    </x-mine.th-cell>
                    <th scope="col" class="px-6 py-3"></th>
                </x-slot>
                <x-slot name="table">
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}?page=${curPage}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell txt="data.grade_level_name"/>
                    <x-mine.td-cell txt="data.subject_name"/>
                    <x-mine.td-cell txt="data.description"/>
                    <x-mine.td-cell txt="data.user_name"/>
                    <x-mine.td-cell txt="data.created_at"/>
                </x-slot>
                <x-slot name="addModal">
                    <x-mine.input title="exam name"/>
                        <x-mine.select-input name="subject_id" title="Subject" :options="$subject"/>
                        <x-mine.select-input name="grade_level_id" title="Grade Level" :options="$gradeLevel" :nullable="true"/>
                        <x-mine.text-area-input name="description" title="exam description"/>
                        <x-mine.input name="num_of_questions" title="Number of Question" type="number"/>
                        <x-mine.input name="time_limit" title="Time limit (in minutes)" type="number"/>
                </x-slot>
                <x-slot name="upModal">
                    <x-mine.input title="exam name" class="capitalize" value="toEdit.name"/>
                        <x-mine.select-input name="subject_id" title="Subject" :options="$subject" selected="toEdit.subject_id"/>
                        <x-mine.select-input name="grade_level_id" title="Grade Level" :options="$gradeLevel" selected="toEdit.grade_level_id" :nullable="true"/>
                        <x-mine.text-area-input name="description" title="exam description" value="toEdit.description"/>
                        <x-mine.input name="num_of_questions" title="Number of Question" type="number" value="toEdit.num_of_questions"/>
                        <x-mine.input name="time_limit" title="Time limit (in minutes)" type="number" value="toEdit.time_limit"/>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
