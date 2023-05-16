export class Task {
    title: string;
    author: string;
    date: Date;
    status: TaskStatus;
    room?: roomType;

    constructor(title: string, author: string, date: Date | string, status?: TaskStatus, room?: roomType) {
        if(typeof date === 'string') date = new Date(Date.parse(date));
        this.title = title;
        this.author = author;
        this.date = date;
        this.status = status || TaskStatus.NOT_STARTED;
        this.room = room;
    }
}

export interface Room {
    name: string,
    members: string[],
    presetRooms: PresetRoom[],
    customRooms: PresetRoom[],
    tasks: Task[],
}

export class TaskStatus {
    static readonly COMPLETED = new TaskStatus(0, "Completed", "#2FDF75");
    static readonly IN_PROGRESS = new TaskStatus(2, "In Progress", "#FF8A1F");
    static readonly NOT_STARTED = new TaskStatus(1, "Not Started", "#FF4961");
    private constructor(public readonly priority: number, public readonly text: string, public readonly color: string) {}
    toString() { return this.text; }
}
export const TaskStatuses: TaskStatus[] = [TaskStatus.NOT_STARTED, TaskStatus.IN_PROGRESS, TaskStatus.COMPLETED];

export class PresetRoom {
    id: roomType;
    name: string;
    icon?: string;
    constructor(id: roomType, name: string, icon?: string) {
        this.id = id;
        this.name = name;
        this.icon = icon;
    }
}
/** 0: kitchen, 1: living, 2: bath, 3: work, 4: dining */
export const presetRooms = [
    new PresetRoom('kitchen', "Kitchen", 'room_kitchen.svg'),
    new PresetRoom('living', "Living room", 'room_living.svg'),
    new PresetRoom('bath', "Bathroom", 'room_bathroom.svg'),
    new PresetRoom('work', "Work room", 'room_work.svg'),
    new PresetRoom('dining', "Dining room", 'room_dining.svg')
];

export function createCustomRoom(name: string): PresetRoom {
    return new PresetRoom('custom', name, 'room_custom.svg')
}

/** 0: kitchen, 1: living, 2: bath, 3: work, 4: dining, 5: custom */
export const presetRoomsWithCustom: PresetRoom[] = presetRooms.concat(new PresetRoom('custom', "Custom room", 'room_custom.svg'));

export type roomType = 'kitchen' | 'living' | 'bath' | 'work' | 'dining' | 'custom';

export function getPresetRoom(id: roomType) {
    return presetRoomsWithCustom.find(room => room.id === id);
}

export class TaskFilter {
    dateOptions: taskFilterDateOptions;
    members: taskFilterMember[];
    status: taskFilterStatus[];
    importance: taskFilterImportance;

    constructor(dateOptions: taskFilterDateOptions, members: taskFilterMember[], status: taskFilterStatus[], importance: taskFilterImportance) {
        this.dateOptions = dateOptions;
        this.members = members;
        this.status = status;
        this.importance = importance;
    }
}

export type dateOptionsValue = 'any' | 'newest' | 'oldest';
export type taskFilterDateOptions = { createdDate: dateOptionsValue, promiseDate: dateOptionsValue, cancelDate: dateOptionsValue };
export type taskFilterMember = { name: string, value: boolean };
export type taskFilterStatus = { status: TaskStatus, value: boolean };
export type taskFilterImportance = 'most' | 'least';
export function getDateOptionsValueSort(a: dateOptionsValue): 1 | -1 | 0 {
    return a === 'newest' ? -1 : (a === 'oldest' ? 1 : 0);
}

export const DefaultTaskFilter: TaskFilter = {
    dateOptions: {
        createdDate: 'any',
        promiseDate: 'any',
        cancelDate: 'any'
    },
    members: [
        {name: "Marek Topolsky", value: true},
        {name: "Richard Egyed", value: true},
        {name: "Sloboda", value: true},
        {name: "Luptacik", value: true}
    ],
    status: [
        {status: TaskStatus.COMPLETED, value: true},
        {status: TaskStatus.IN_PROGRESS, value: true},
        {status: TaskStatus.NOT_STARTED, value: true}
    ],
    importance: 'most'
}

export const placeholderTasks: Task[] = [
    new Task("UPRAC KUCHYNU", "Richard Egyed", '2023-1-12', TaskStatus.IN_PROGRESS, 'kitchen'),
    new Task("ALE NO UZ", "Luptacik", '2023-1-15', TaskStatus.NOT_STARTED, 'bath'),
    new Task("CHOD DOMOV", "Sloboda", '2023-1-12', TaskStatus.COMPLETED, 'living'),
    new Task("UPRAC SVOJU IZBU", "Marek Topolsky", '2023-1-24', TaskStatus.COMPLETED, 'work')
]
export const placeholderMembers: string[] = [
    "Marek Topolsky",
    "Richard Egyed",
    "Sloboda",
    "Luptacik"
]