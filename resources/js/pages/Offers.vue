<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Offer, User } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { ref } from 'vue';
import { FlexRender, getCoreRowModel, getPaginationRowModel, useVueTable } from '@tanstack/vue-table';
import { userColumns } from '@/tables/userColumns';
import { offerColumns } from '@/tables/offerColumns';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { providerColumns } from '@/tables/providerColumns';



const props = defineProps<{
    offers: Offer[]
}>();

console.log(props.offers);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Offers',
        href: '/offers'
    }
];



const data = ref<Offer[]>(props.offers);
const table = useVueTable({
    columns: offerColumns,
    columnResizeMode: 'onChange',
    enableColumnResizing: true,
    data,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    initialState: {
        pagination: {
            pageSize: 5,
        },
    },
});

</script>

<template>
    <Head title="Offers" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <Card className="w-full">
                        <CardHeader>
                            <CardTitle>Total Pending</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">
                                {{ offers.filter(offer => offer.state === 1).length }}
                            </div>
                            <p className="text-xs text-muted-foreground">Pending offers are offers that are waiting for
                                a provider to accept or see them</p>
                        </CardContent>
                    </Card>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <Card className="w-full">
                        <CardHeader>
                            <CardTitle>Total Confirmed</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">
                                {{ offers.filter(offer => offer.state === 3).length }}
                            </div>
                            <p className="text-xs text-muted-foreground">Confirmed offers are offers that have been
                                accepted by a provider</p>
                        </CardContent>
                    </Card>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <Card className="w-full">
                        <CardHeader>
                            <CardTitle>Total Offers</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{{ offers.length }}</div>
                            <p className="text-xs text-muted-foreground">This includes all the pending, accepted and
                                canceled offers</p>
                        </CardContent>
                    </Card>
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <Table class="w-full rounded-xl border shadow-sm text-sm">
                    <TableHeader class="bg-muted/50">
                        <TableRow
                            v-for="headerGroup in table.getHeaderGroups()"
                            :key="headerGroup.id"
                        >
                            <TableHead
                                v-for="header in headerGroup.headers"
                                :key="header.id"
                                :colspan="header.colSpan"
                                :style="{ width: header.getSize() + 'px' }"
                                class="px-4 py-3 text-left font-medium text-muted-foreground text-xs uppercase border-b"
                            >
                                <template v-if="!header.isPlaceholder">
                                    <FlexRender
                                        :render="header.column.columnDef.header"
                                        :props="header.getContext()"
                                    />
                                </template>
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow
                            v-for="row in table.getRowModel().rows"
                            :key="row.id"

                            class="hover:bg-muted/30 transition-colors"
                        >
                            <TableCell
                                v-for="cell in row.getVisibleCells()"
                                :key="cell.id"
                                :style="{ width: cell.column.getSize() + 'px' }"
                                class="px-4 py-3 border-b"
                            >
                                <FlexRender
                                    :render="cell.column.columnDef.cell"
                                    :props="cell.getContext()"
                                />
                            </TableCell>
                        </TableRow>

                        <TableRow v-if="table.getRowModel().rows.length === 0">
                            <TableCell
                                :colspan="providerColumns.length"
                                class="text-center text-muted-foreground py-4"
                            >
                                No results found.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <div class="flex justify-between items-center mt-4">
                    <!-- Left: Page Navigation -->
                    <div class="flex items-center gap-2">
                        <button
                            @click="table.previousPage"
                            :disabled="!table.getCanPreviousPage()"
                            class="inline-flex h-9 items-center justify-center rounded-md border border-input bg-background px-3 text-sm font-medium text-foreground shadow transition-colors hover:bg-accent hover:text-accent-foreground disabled:opacity-50"
                        >
                            Précédent
                        </button>
                        <button
                            @click="table.nextPage"
                            :disabled="!table.getCanNextPage()"
                            class="inline-flex h-9 items-center justify-center rounded-md border border-input bg-background px-3 text-sm font-medium text-foreground shadow transition-colors hover:bg-accent hover:text-accent-foreground disabled:opacity-50"
                        >
                            Suivant
                        </button>
                    </div>

                    <!-- Right: Page Info + Page Size -->
                    <div class="flex items-center gap-4">
      <span class="text-sm text-muted-foreground">
        Page {{ table.getState().pagination.pageIndex + 1 }}
        sur {{ table.getPageCount() }}
      </span>

                        <select
                            v-model.number="table.getState().pagination.pageSize"
                            class="h-9 rounded-md border border-input bg-background px-2 text-sm text-foreground shadow-sm"
                        >
                            <option :value="5">5 lignes</option>
                            <option :value="10">10 lignes</option>
                            <option :value="20">20 lignes</option>
                        </select>
                    </div>
                </div>


            </div>
        </div>
    </AppLayout>
</template>
