export class User {
    id: number;
    room_id: number;
    email: string;
    name: string;
    surname: string;
    registered_at: string;
    avatar?: string;
    constructor(id: number, room_id: number, email: string, name: string, surname: string, registered_at: string, avatar?: string) {
        this.id = id;
        this.room_id = room_id;
        this.email = email;
        this.name = name;
        this.surname = surname;
        this.registered_at = registered_at;
        this.avatar = avatar;
    }
}

export type miniRoom = {id: number, name: string};

export class Task {
    id: number;
    miniroom: miniRoom;
    name: string;
    description: string;
    user_created: string;
    user_assigned: string;
    deadline: Date;
    status: TaskStatus;
    room?: roomType;

    constructor(id: number, name: string, description: string, user_created: string, user_assigned: string, deadline: Date | string, status?: TaskStatus, room?: roomType) {
        if(typeof deadline === 'string') deadline = new Date(Date.parse(deadline));
        this.id = id;
        this.name = name;
        this.description = description;
        this.user_created = user_created;
        this.user_assigned = user_assigned;
        this.deadline = deadline;
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
    static readonly COMPLETED = new TaskStatus(3, "Completed", "#2FDF75");
    static readonly IN_PROGRESS = new TaskStatus(2, "In Progress", "#FF8A1F");
    static readonly NOT_STARTED = new TaskStatus(1, "Not Started", "#FF4961");
    private constructor(public readonly id: number, public readonly text: string, public readonly color: string) {}
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
    assignedTo?: number[];
    minirooms?: number[];

    constructor(dateOptions: taskFilterDateOptions, members: taskFilterMember[], status: taskFilterStatus[], assignedTo?: number[], minirooms?: number[]) {
        this.dateOptions = dateOptions;
        this.members = members;
        this.status = status;
        this.assignedTo = assignedTo;
        this.minirooms = minirooms;
    }
}

export type dateOptionsValue = 'any' | 'newest' | 'oldest';
export type taskFilterDateOptions = { createdDate: dateOptionsValue, promiseDate: dateOptionsValue, cancelDate: dateOptionsValue };
export type taskFilterMember = { name: string, id: number };
export type taskFilterStatus = { status: TaskStatus, value: boolean };
export type taskFilterImportance = 'most' | 'least';
export function getDateOptionsValueSort(a: dateOptionsValue): 1 | -1 | 0 {
    return a === 'newest' ? -1 : (a === 'oldest' ? 1 : 0);
}

export const DefaultTaskFilterStatuses: taskFilterStatus[] = [
    {status: TaskStatus.COMPLETED, value: false},
    {status: TaskStatus.IN_PROGRESS, value: true},
    {status: TaskStatus.NOT_STARTED, value: true}
]

export const DefaultTaskFilter: TaskFilter = {
    dateOptions: {
        createdDate: 'any',
        promiseDate: 'any',
        cancelDate: 'any'
    },
    members: [],
    status: DefaultTaskFilterStatuses,
}

export const placeholderTasks: Task[] = [
    new Task(0, "UPRAC KUCHYNU", "",  "Richard Egyed", "a", '2023-1-12', TaskStatus.IN_PROGRESS, 'kitchen'),
    new Task(1, "ALE NO UZ", "", "Luptacik", "a", '2023-1-15', TaskStatus.NOT_STARTED, 'bath'),
    new Task(2, "CHOD DOMOV", "", "Sloboda", "a", '2023-1-12', TaskStatus.COMPLETED, 'living'),
    new Task(3, "UPRAC SVOJU IZBU", "", "Marek Topolsky", "a", '2023-1-24', TaskStatus.COMPLETED, 'work')
]
export const placeholderMembers: string[] = [
    "Marek Topolsky",
    "Richard Egyed",
    "Sloboda",
    "Luptacik"
]
