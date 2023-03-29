export class Task {
    title: string;
    author: string;
    priority: Priority;

    constructor(title: string, author: string, priority: Priority) {
        this.title = title;
        this.author = author;
        this.priority = priority;
    }
}

export enum Priority {
    LOW,
    MEDIUM,
    HIGH
}

export class PresetRoom {
    id: string;
    name: string;
    icon?: string;
    constructor(id: string, name: string, icon?: string) {
        this.id = id;
        this.name = name;
        this.icon = icon;
    }
}

export const presetRooms = [
    new PresetRoom('kitchen', "Kitchen", 'room_kitchen.svg'),
    new PresetRoom('living', "Living Room", 'room_living.svg'),
    new PresetRoom('bath', "Bathroom", 'room_bathroom.svg'),
    new PresetRoom('work', "Work Room", 'room_work.svg'),
    new PresetRoom('dining', "Dining Room", 'room_dining.svg')
];

export const presetRoomsWithCustom:PresetRoom[] = presetRooms.concat(new PresetRoom('custom', "Custom", 'room_custom.svg'));