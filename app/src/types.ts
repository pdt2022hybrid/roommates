export class Task {
    title: string;
    author: string;
    date: Date;
    priority: Priority;
    room?: roomType;

    constructor(title: string, author: string, date: Date | string, priority?: Priority, room?: roomType) {
        if(typeof date === 'string') date = new Date(Date.parse(date));
        this.title = title;
        this.author = author;
        this.date = date;
        this.priority = priority || Priority.LOW;
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

export class Priority {
    static readonly LOW = new Priority(0, "DECENT", "#2FDF75");
    static readonly MEDIUM = new Priority(1, "IMPORTANT", "#FF8A1F");
    static readonly HIGH = new Priority(2, "VERY IMPORTANT", "#FF4961");
    private constructor(public readonly priority: number, public readonly text: string, public readonly color: string) {}
    toString() { return this.text; }
}

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